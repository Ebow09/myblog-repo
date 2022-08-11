<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
//use TCG\Voyager\Models\Post;
use App\Models\Post;
use Carbon\Carbon;

class RssFeedController extends Controller
{
    public function feed()
    {
        //Allow RSS feed from the day before
        $yesterday = Carbon::yesterday();
        $yesterday = date($yesterday).' 00:00:00'; 
        
        //Get posts and the author and display on the index page
        $posts = Post::where('publishedAt', '>=', $yesterday)
        ->join('users', 'users.id', '=', 'posts.user_id')
        ->select('*','posts.id as postid')
        ->orderBy('posts.created_at', 'desc')
        ->limit(50)->get();
        return response()->view('rss.feed', compact('posts'))->header('Content-Type', 'application/xml');

      /*   $posts = Post::where('publishedAt', '>=', $yesterday)->
        orderBy('created_at', 'desc')->
        limit(50)->get();
        return response()->view('rss.feed', compact('posts'))->header('Content-Type', 'application/xml'); */

    }
}