@extends('layouts.app')
   
@section('content')
    <script>       
        window.onload = function WindowLoad(event) {
            var y = document.getElementById("pic");
            y.style.display = "none";
        } 
        function addpic() {
            var x = document.getElementById("pic");
            if (x.style.display === "none") {
                x.style.display = "block";
                document.getElementById("photo").focus();
            } else {
                x.style.display = "none";
            }
        }
</script>
    <div class="card mt-5">
        <div class="card-header">
            <h2>Felula blog - Edit your blog</h2>
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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Oops!</strong> Looks like there is a problem with the data you entered.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                  
                    <form action="/update" method="POST" enctype="multipart/form-data">
                        @csrf     
                         <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <input type="hidden" name="postid" value="{{ $post->id }}">
                                    <input type="hidden" name="picname" value="{{$post->imagename}}">
                                    <strong>Title:</strong>
                                    <input type="text" name="title" value="{{ $post->title }}" class="form-control" placeholder="Title" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Description:</strong>
                                    <textarea class="form-control" style="height:150px" name="description" placeholder="Description" required> {{ $post->content }}</textarea>
                                </div>
                            </div>                           
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <?php  
                                    $imagename = $post->imagename;
                                    $path ='storage/app/public/uploads/';
                                    $filename =$path.$imagename;                                     
                                ?>                             
                                <img src="{{asset('storage/uploads/'.$post->imagename)}}" class="img-fluid" alt="<?php echo $post->title; ?>" >
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="row">
                                    <div class="col-sm-1">&nbsp;</div>
                                    <div class="col-sm-3"> <a href="#" onclick="addpic()"  class="btn btn-primary btn-sm mt-2"> Change image</a></div>
                                    <div class="col-sm-8">&nbsp;</div>
                                </div>
                           
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mt-2" > 
                                <div class="row">           
                                    <div class="col-sm-6 text-muted">
                                    <span style="font-size:14px;">Change/Upload New Image</span><br>
                                    <input type="file" class="form-control" id="photo" name="photo" onchange="return Filevalidation()" />   
                                    </div>
                                    <div class="col-sm-6 mt-4" >
                                       &nbsp;
                                    </div>      
                                </div> 
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                              <button type="submit" class="btn btn-success btn-sm" >Save Changes</button>
                            </div>
                        </div>
                    </form>
                    <script>
                        function Filevalidation(){     
                            const fi = document.getElementById('photo');
                            // Check if any file is selected.
                            if (fi.files.length > 0) {
                                for (const i = 0; i <= fi.files.length - 1; i++) {    
                                    const fsize = fi.files.item(i).size;
                                    const file = Math.round((fsize / 1024));
                                    // The size of the file.
                                    if (file >= 2048) {
                                        alert(
                                        "Your image or file is too Big, please select a file less than 2mb");  
                                        document.getElementById('photo').value= null;  
                                        document.getElementById('photo').focus() 
                                        return false;                
                                    } 
                                }
                            }
                        }
                       
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection