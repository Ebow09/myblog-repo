<!DOCTYPE html>
<html>
<head>
    <title>Felula Blog</title>
    @livewireStyles
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body style="background: #e2e2e2;">  
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 bg-white">
                @include('inc.navbar') 
            </div>
           
            <div class="col-md-10 offset-1">
                @yield('content')
            </div>
        </div>
        <footer id="footer" class="row-footer mt-2" style="position: relative; bottom: 0; width:98.8%; background: #e2e2e2; padding-left:40px;">   
            <div class="row" style="background:#e2e2e2"> 
  
                <div class="col-2"><a type="button" class="btn btn-warning btn-sm btn-block" href="/feed"> RSS Feed </a></div>
                <div class="col-8">&nbsp;</div>
                <div class="col-2"><a type="button" class="btn btn-dark btn-sm btn-block" href="/importdata"> Import CSV</a></div>
            </div>
        </footer>
        <div class="row"> &nbsp; </div>
    </div>   
</body>
</html>