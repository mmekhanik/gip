

<nav class="navbar navbar-expand-md navbar-light bg-light navbar-fnt navbar-default">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExample04">
    <ul class="navbar-nav navbar-menu mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
       <li class="nav-item  ">
        <a class="nav-link" href="/articles">Articles</a>
      </li>
       <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="/post" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Articles</a>
        <div class="dropdown-menu" aria-labelledby="dropdown04">
          <a class="dropdown-item" href="/articles">Articles</a>
          <a class="dropdown-item" href="/post">Blogs</a>
          <a class="dropdown-item" href="/post/create">Create Blog</a>
        </div>
      </li> -->
       <li class="nav-item">
        <a class="nav-link" href="/albums">Gallery</a>
      </li>
     <!--  <li class="nav-item  ">
        <a class="nav-link" href="{{ route('service') }}">Services</a>
      </li> -->
      <li class="nav-item ">
        <a class="nav-link" href="{{ url('about') }}">About Us</a>
      </li>
       <li class="nav-item ">
        <a class="nav-link" href="{{ route('contactacl') }}">Contact</a>
      </li>
      @auth
        <!-- <li class="nav-item ">
          <a class="nav-link" href="{{ route('dash') }}">Dashboard</a>
        </li>   -->  
      @endauth
    </ul> 
     @if(Auth::check())

     <ul class="navbar-nav ml-auto">
      <li class="nav-item ">
       <a class="nav-link"  href="{{ url('dashboard') }}"> <img class="ui avatar mini image  hidden-mobile" src="{{(!empty(Auth::user()->avatar))? url('/storage/images/avatars/'.Auth::user()->avatar) : url('images/avatars/avatar_default.png') }}">&nbsp;Dashboard</a>
      </li>
    @if(Session::has( config('blogger.auth.impersonification.session_name')))
    <li class="nav-item ">
       <a class="nav-link hidden-mobile hidden-tablet" href="{{ url('dashboard/back-to-admin-mode') }}" name="back-to-admin-mode"><i class="spy icon"></i> Back to Admin Mode</a>
    </li>
      @endif
      <!-- <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
           {{  Auth::user()->name }}
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a>
          {{-- <a class="dropdown-item" href="#">Activity Log</a>
          <div class="dropdown-divider"></div> --}}

          <a class="dropdown-item" href="#" data-toggle="modal" onclick="event.preventDefault();document.querySelector('#logout').submit();" data-target="#logoutModal">Logout</a>
        <form id="logout" action="{{ route('logout') }}" method="POST">
        @csrf
        </form>
        </div>
      </li> -->
    </ul>
      @endif
    <!-- <form class="form-inline my-2 my-md-0">
      <input class="form-control" type="text" placeholder="Search">
    </form> -->
  </div>
</nav>

<!--   <nav class="nav nav-underline">
    <a class="nav-link" href="/">Home</a>
    <a class="nav-link" href="#">
      Friends
      <span class="badge badge-pill bg-light align-text-bottom">27</span>
    </a>
    <a class="nav-link" href="/post" class="active">Blogs</a>
    <a class="nav-link" href="/post/create">Create Post</a>
    <a class="nav-link" href="/about" >About Us</a>
     @if(Auth::check())
        <a class="navbar-toggler ml-auto" href="#">{{  Auth::user()->name }}</a>
      @endif
     
  </nav> -->


<!-- <div class="site-navbar py-0" role="banner">
 <div class="container">
    <div class="row justify-content-center">
       <div class="col-10 col-md-10 d-none d-lg-block" data-aos="fade-down">

          <nav class="site-navigation position-relative text-right text-lg-left" role="navigation">
          
            <ul class="site-menu js-clone-nav d-none d-lg-block">
              <li class="active"><a href="/">Home</a></li>
              <li ><a href="/post">Blogs</a></li>
                <li class="has-children">
                    <a href="#">Profile</a>
                    <ul class="dropdown">
                      <li>
                        <a href="/post">Blogs</a>
                    </li>
                    <li>
                        <a href="/post">Blogs</a>
                    </li>
               </ul>
              </li>
              <li ><a href="{{ route('homepage')}}">Gallery</a></li>      
              <li><a href="{{ route('service') }}">Services</a></li>
              <li><a href="{{ route('about') }}">Team</a></li>
              <li><a href="/about">About</a></li>
              <li><a href="{{ route('contactacl') }}">Contact</a></li>
          
                 @guest
                <li><a href="{{ route('register') }}">Register</a></li>
                <li class="navbar-toggler mr-auto" ><a  href="{{ route('login') }}">Login</a></li>
                              
                @endguest 
                @auth
                <li><a href="{{ route('dash') }}">Dashboard</a></li>
                
              @endauth

            </ul>
          </nav>
        </div>
        <div class="col-6 col-xl-2" data-aos="fade-down">
           <div class="site-navigation text-lg-left">
             @if(Auth::check())
             <ul class="site-navigation site-menu">
                <li class="active"><a href="#">{{  Auth::user()->name }}</a></li>
              </ul>
              @endif
           </div>
        </div>
       </div>
  </div>
</div> -->
