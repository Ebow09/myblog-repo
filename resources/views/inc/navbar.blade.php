<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
<style>
    /*  .navbar-nav > .active > a {
        color: blue;
        background-color: #4e4b4a;    
    }
    .nav-item > a:hover {
        color: white;
    } */    
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-white" > <!-- light to dark-->
           
    <a class="navbar-brand" href="/"> 
    <span style="color:#000000; font-weight:bold;">Felula Limited</span>
    </a>             
                <span>&nbsp; &nbsp;  </span>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="font-weight:bold; font-size:1.1em; color:#000000; ">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">   
                        <li class="nav-item">                        
                            <a class="nav-link" href=""><span style="color:#000000;"> Home</span> </a>
                          </li>                     
                        <li class="nav-item">                        
                            <a class="nav-link" href=""><span style="color:#000000;"> About Us</span> </a>
                          </li>
                      
                       
                          <li class="nav-item">
                            <a class="nav-link" href=""><span style="color:#000000;">  &nbsp;&nbsp; </span> </a>
                          </li> 
                       
                       
                         <!--     <li class="nav-item active">
                            <a class="nav-link" href="/accessories"><span style="color:#505050;">  Optional  </span></a>
                          </li>-->
                        <li> &nbsp;</li>          
                    </ul>
                   
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto" style="font-size:0.8em;">
           
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"> <span style="color:#000000; font-size:12pt">{{ __('Login') }}</span></a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"><span style="color:#000000; font-size:12pt">{{ __('Register') }}</span></a>
                                </li>
                            @endif
                        @else
                        <li class="dropdown">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle"  style="color:#000000;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   <span style="color:#000000;"> {{ Auth::user()->name }} </span><span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                 
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <span style="color:#000000; font-size:11px;"> {{ __('Logout') }}</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>                       
                        @endguest<li>&nbsp;</li>
                        
                       
                    </ul>
              
                </div>
        
        </nav>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
