<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Response;

class BlogController extends Controller
{
    public function index()
    {
        
        return Post::all();
        
    }
 
    public function show($id)
    {
      /*   return [
            'id' => 'required|integer',
        ]; */
        if(!is_numeric($id)){
            return response() -> json(['message' => 'Error you must enter a valid post id to search']);
            exit();
        } 
        return Post::find($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'content' => 'required',
            'photo' => 'nullable|mimes:png,jpg,jpeg,gif,pdf|max:2048',
        ]);
        
        $post= Post::create($request->all());
        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {
        if(!is_numeric($id)){
            return response() -> json(['message' => 'Error you must enter a valid post id to search']);
            exit();
        } 
        $post = Post::findOrFail($id);
        $post->update($request->all());

        return response()->json($post, 200);
    }

    public function destroy(Request $request, $id)
    {
        if(!is_numeric($id)){
            return response() -> json(['message' => 'Error you must enter a valid post id to search']);
            exit();
        } 

        $post = Post::where('id', $id)->firstorfail()->delete();  
      //  $post->delete();

        return response()->json(null, 204);
    }
}
