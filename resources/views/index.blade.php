@extends('layouts.app')
 
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card mt-5 w-100">
            <div class="card-header">
                <h2>Felula Blogs</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 mt-1 mr-1">
                        <div class="float-right">
                            <a class="btn btn-success" href="/create"> Create New Post</a>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-12">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{$message}}</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-12">
                        @if ($message = Session::get('fail'))
                            <div class="alert alert-danger">
                                <p>{{$message}}</p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">                
                        <div class="col-12"> 
                            <div class="card  border-0">
                                <div class="card-body">                                 
                                @foreach ($posts as $post)  
                                <div class="card p-4"> 
                                    <!--Display data from the controller method -->
                                    <form  action="/delete/{{$post->postid}}" method="POST">    
                                        @csrf                                     
                                        <h6 > <span class="text-muted font-weight-bold" >{{ $post->postid }}. </span> {{ $post->title }}   </h6>
                                        <p> {{ \Str::limit($post->content, 75) }} </p> 
                                        <h6 class="text-muted">Author: {{ $post->name }} </h6>
                                        <div class="row"> 
                                            <div class="col-2">&nbsp;</div>
                                            <div class="col-2"> <button type="submit" class="btn btn-danger btn-sm btn-block">Delete </button></div>
                                            <div class="col-1">&nbsp;</div>
                                            <div class="col-2"><a type="button" class="btn btn-primary btn-sm btn-block" href="/show/{{$post->postid}}">View </a></div>
                                            <div class="col-1">&nbsp;</div>
                                            <div class="col-2"><a type="button" class="btn btn-warning btn-sm btn-block" href="/edit/{{$post->postid}}"> Edit </a></div>
                                            <div class="col-2">&nbsp;</div>
                                        </div>  
                                    </form>                                  
                                </div>
                                <br>
                                @endforeach                                
                                </div>
                                <div class="text-center">
                                        {{ $posts->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection