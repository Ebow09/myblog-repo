@extends('layouts.app')
  
@section('content')
    <script>
        function addcomment() {
            var x = document.getElementById("commentfield");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
        window.onload = function WindowLoad(event) {
            var y = document.getElementById("commentfield");
            y.style.display = "none";
        } 
    </script>
    <div class="card mt-5">
        <div class="card-header">
            <h2>Post details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 mt-1 mr-1">
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('index') }}"> Back</a>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                </div>
                <div class="col-lg-12">
                    <div class="row">
                    
                        <div class="col-xs-12 col-sm-12 col-md-12">                            
                           

                        <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                                <strong>Title:</strong>                               
                                {{ $post->title }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Content:</strong>
                                {{ $post->content }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                           <!--image goes here -->
                           <?php  
                                $imagename = $post->imagename;
                                $path ='storage/app/public/uploads/';
                                $filename =$path.$imagename;                                     
                            ?>                             
                            <img src="{{asset('storage/uploads/'.$post->imagename)}}" class="img-fluid" alt="<?php echo $post->title; ?>" >
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <!--Add comments here -->
                                <strong>Comments:</strong> <br>
                                @foreach ($comments as $comment)                             
                                    {{ $comment->comment }}
                                    <br>
                                @endforeach  
                            </div> 
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a href="#" onclick="addcomment()"  class="btn btn-primary btn-sm">Add Comment </a>                                
                        </div>
                       
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-4 text-center" id="commentfield">
                            <form action="/savecomment" method="POST">
                                @csrf  
                                <input type="hidden" name="postid" id="postid" value="{{ $post->id }}">
                                <input type="hidden" name="title" id="title" value="{{ $post->title }}">
                                <div class="form-group">                                
                                    <textarea  class="form-control" rows="3" name="comment" required> </textarea>
                                </div>
                                <button type="submit" class="btn btn-success"> Save Comment </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
@endsection