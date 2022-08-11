<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\CsvData;
use App\Models\Post;

class ImportController extends Controller
{
    public function getImport()
    {
        return view('import');
    }

    public function parseImport( Request $request)
    {
        //validate title and content for every post
        $request->validate([           
            'csv_file' => 'nullable|mimes:csv|max:2048',
        ]);
        //import the data from the csv file and store in an array
        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));   
              
        //save to temp table                       
        if (count($data) > 0) {             
            $csv_data = array_slice($data, 0, 5); //Get only 5 records for sample to display to user               
            $csv_data_file = CsvData::create([
                'csv_header' => $request->has('header'),
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }          
        //display the data on a form and ask user to confirm and run process import
        return view('import_fields', compact( 'csv_data', 'csv_data_file', 'path'));
    }

    public function processImport(Request $request)
    {       
        //Since only registered users (logged in) can post user_id required
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        //if the header field is included, remove it before saving the data to the table
        if ($request->has('header')) {
            unset($csv_data[0]);
        }
        $errorfound = false;
        try {
            foreach ($csv_data as $row) {               
                    $dt= strtotime($row[3]); //convert string to a date
                    $dt1 = date('Y/m/d H:i:s',$dt);              
                    $imptdata = new Post();
                    $imptdata  -> title = $row[0];          
                    $imptdata  -> content =  $row[1];   
                    $imptdata  -> user_id =  $row[2];   
                    $imptdata  -> publishedAt =  $dt1; 
                    $imptdata->save();                
            }   
        } catch(Exception $e) {
            $errorfound = true;
        }finally {
            if ($errorfound == true)
            {
                return redirect()->route('index')
                ->with('fail','Error in the data - has your CSV file got these fields - title, content, user_id, published date? Check your data and try again.');  
            } else {
                return redirect()->route('index')
                ->with('success','Posts imported successfully.');  
            }            
        }     
       
    }
}
