<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Users;
use File;
use Response;
use Illuminate\Support\Facades\Storage;
use PDF;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get posts and the author and display on the index page
        $posts = Post::join('users', 'users.id', '=', 'posts.user_id')
        ->select('*','posts.id as postid')
        ->orderBy('postid', 'desc')
        ->simplePaginate(10); 
          
        return view('index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Display form to allow data to be entered to create a post
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
       //validate title and content for every post
        $request->validate([
            'title' => 'required|max:50',
            'content' => 'required',
            'photo' => 'nullable|mimes:png,jpg,jpeg,gif,pdf|max:2048',
        ]);
        $targetFile="";
        //Upload Photo
        if($request->hasFile('photo'))
        {
            $allowedfileExtension=['jpg','png', 'jpeg', 'gif', 'pdf'];
            $file = $request->file('photo');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $check=in_array($extension,$allowedfileExtension);
            $filename1 = $filename;     
            
            $title = substr($request ->input('title'), 0, 10);           

            if($check)
            {      
                $targetFile = substr(rand(0, time()), 0, 9).'photo_'.auth()->user()->id.$title .".".$extension;
                if (strlen($targetFile)> 49) {
                    $targetFile = substr($targetFile,0,49);
                } 
                $disk = Storage::disk('appfiles');
                //to cater for slow internet connection and hand=ging applications
                $disk->put($targetFile, fopen($file, 'r+'));
            }           
        } 
        //create a post and re-open index page with success message
        $sdata = new Post;     
        $sdata  -> title = $request ->input('title');          
        $sdata  -> content = $request ->input('content'); 
        $sdata  -> imagename = $targetFile;    
        $sdata  -> user_id = auth()->user()->id;  
        $sdata  ->save(); 
        return redirect()->route('index')
                        ->with('success','Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //filter db for specific blog      
        $post = Post::where('id', $id)->first();

        //filter to get all comments for this blog
        $comments = Comment::where('postId', $id)->get();
        return view('show',compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        //filter db for specific blog      
        $post = Post::where('id', $id)->first();

        return view('edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //validate title and content for updated post 
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'nullable|mimes:png,jpg,jpeg,gif,pdf|max:2048',
        ]);
       // $targetFile ="";
        $targetFile = $request ->input('picname');
        //Upload Photo
        if($request->hasFile('photo'))
        {           
            $allowedfileExtension=['jpg','png', 'jpeg', 'gif', 'pdf'];
            $file = $request->file('photo');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $check=in_array($extension,$allowedfileExtension);
            $filename1 = $filename;     
            
            $title = substr($request ->input('title'), 0, 10);           

            if($check)
            {      
                $targetFile = substr(rand(0, time()), 0, 9).'photo_'.auth()->user()->id.$title .".".$extension;
                if (strlen($targetFile)> 49) {
                    $targetFile = substr($targetFile,0,49);
                } 
                $disk = Storage::disk('appfiles');
                //to cater for slow internet connection and hand=ging applications
                $disk->put($targetFile, fopen($file, 'r+'));
            }           
        } 
        //imagename = $targetFile; 
        //update the post using the id from the form
        $update =  Post::where('id',  $request ->input('postid') )->update(['title'=> $request ->input('title') , 'content'=>$request ->input('description'), 'imagename' =>$targetFile]);
         
        return redirect()->route('index')
                        ->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {       
       //check to see if id passed from get is a number
        if (!is_numeric($id)){
            return redirect()->route('index')
                ->with('fail','The post id does not exist');
        }

        //if validation passed delete the record and return to the index displaying a success message
        $user = Post::where('id', $id)->firstorfail()->delete();   
        return redirect()->route('index')
                        ->with('success','Post deleted successfully');
    }

    public function usercomment(Request $request)
    {
        //validate comment 
        $request->validate([
            'comment' => 'required',
        ]);
        
        if (!is_numeric($request ->input('postid'))){
            $postid= 0;
        } else {
            $postid = $request ->input('postid');
        }
        
        
        //Save new comment from guest and return to comment form with a success message
        $sdata = new Comment;     
        $sdata  -> title = $request ->input('title');          
        $sdata  -> comment = $request ->input('comment'); 
        $sdata  -> postId = $postid;    
        $sdata  ->save();
              
        return back()->with('success','Comment added successfully');
      
    }
    
}
