@extends('layouts.app')
  
@section('content')
<div class="card mt-5">
        <div class="card-header">
            <h2>Felula blog - Create a new blog</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 mt-1 mr-1">
                    <div class="float-right">
                        <a class="btn btn-primary" href=""> Back</a>
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
                       
                    <form action="/store" method="POST" enctype="multipart/form-data">
                        @csrf
                      
                         <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Title:</strong>
                                    <input type="text" name="title" class="form-control" placeholder="Title" maxlength="50">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Content:</strong>
                                    <textarea class="form-control" rows="6" name="content" placeholder="Content"></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="row">    
                                    <div class="col-sm-3">&nbsp;</div>                               
                                    <div class="col-sm-6 text-muted">
                                    <span style="font-size:14px;">Upload your an image or pdf file for you post (max size 2MB) Optional</span><br>
                                    <input type="file" class="form-control" id="photo" name="photo" onchange="return Filevalidation()" />   
                                    </div>                                
                                    <div class="col-sm-3">&nbsp;</div>
                                </div> 
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                &nbsp;
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection