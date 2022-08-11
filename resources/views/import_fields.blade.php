@extends('layouts.app')
   
@section('content')
<div class="card mt-5">
    <div class="card-header">
        <h5>Felula blog - Check if the fields from the sample data are accurate before importing.</h5>
            If not adjust or delete the unwanted columns in the CSV file
    </div>
    <div class="card-body">
        <div class="row">
            <form class="form-horizontal" method="POST" action="{{ route('import_process') }}">
                {{ csrf_field() }}
                <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}" />
                <input type="hidden" name="file_path" value="{{ $path }}" >
                <table class="table">    
                    @foreach ($csv_data as $row)          
                        @foreach ($row as $key => $value)                     
                            <td>{{ $value }}</td>
                        @endforeach
                        </tr>
                    @endforeach       
                </table>
                <div class="row">
                    <div class="col-6"> </div>
                    <div class="col-3">
                    <div class="form-group">                        
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="header" checked> File contains header row?
                            </label>
                        </div>                        
                    </div>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary btn-sm btn-block">Import Data</button>
                    </div>
                    <div class="col-1">&nbsp;</div>
                </div>               
            </form>
        </div>
    </div>
</div>
@endsection