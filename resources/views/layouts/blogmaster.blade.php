<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Gipirion Inc @yield('title')</title>
   
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/blog/">

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


    <!-- Favicons -->

     <!-- <link rel="icon" href="../../public/favicon.ico" type="image/x-icon"> -->
<link rel="apple-touch-icon" href="/img/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/img/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/img/favicon-16x16.png" sizes="16x16" type="image/png">
<!-- <link rel="manifest" href="/img/favicons/manifest.json"> -->
<!-- <link rel="mask-icon" href="/img/safari-pinned-tab.svg" color="#563d7c"> -->
<link rel="icon" href="/img/favicon.ico">
<meta name="msapplication-config" content="/img/browserconfig.xml">
<meta name="theme-color" content="#563d7c">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
      .blog_hd {
        text-align: center;
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/lightbox.css" rel="stylesheet">
   
  </head>
  <body>

    <div class="container">
    @include('flash::message')

  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="text-muted" href="#subscribe">Subscribe</a>
      </div>
      <div class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="#">Gipirion</a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        <a class="text-muted" href="#" aria-label="Search">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24" focusable="false"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
        </a>

        @guest
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('login') }}">Sign Up</a>
          @if (Route::has('register'))
            <div class="col-md-6">
                  <a class="btn btn-sm btn-outline-secondary" href="{{ route('register') }}">{{ __('Register') }}</a>
            </div>
          @endif
        @else
        <div class="col-md-6">
          <a class="btn btn-sm btn-outline-secondary" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
         @endguest
      </div>
    </div>
  </header>

  @include('layouts.blognav')

  @yield('longtitle')
  @yield('topposts')
  

<main role="main" class="container">
 
    
    @yield('content')
    <!-- @yield('side') -->
   <!--  @include('layouts.blogside') -->

 

</main><!-- /.container -->
<script src="//code.jquery.com/jquery.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script>
  $('#flash-overlay-modal').modal();
  $('div.alert').not('.alert-important').delay(3000).slideUp(300);
</script> 
<!-- <script src="/js/all.js"></script> -->
  @include('layouts.blogfooter')
</body>
</html>
