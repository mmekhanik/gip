<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    @yield('og-title')
    @yield('og-image')
    @yield('og-description')

  <!--SEO-->
    <meta name="author" content="{{ Settings::getMetaAuthor() }}">
    <meta name="keywords" content="{{ Settings::getMetaKeywords() }}">
    <meta name="description" content="{{ Settings::getMetaDescription() }}">

    <title>{{ config('app.name') }} | @yield('title', Settings::getMetaTitle())</title>

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="/bootstrap-4.5.0-dist/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Favicons -->
  <link rel="apple-touch-icon" href="/img/apple-touch-icon.png" sizes="180x180">
  <link rel="icon" href="/img/favicon-32x32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="/img/favicon-16x16.png" sizes="16x16" type="image/png">
  <!-- <link rel="manifest" href="/img/favicons/manifest.json"> -->
  <!-- <link rel="mask-icon" href="/img/safari-pinned-tab.svg" color="#563d7c"> -->
  <link rel="icon" href="/img/favicon.ico">
  <meta name="theme-color" content="#563d7c">
   <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Scripts -->
  <script>
      window.Blogger = {
          url : "http://gipirion.local"
      }
      console.log(window.Blogger);
  </script>
 <!--  <script src="{{ url('js/app.js') }}" ></script> -->
    <style>
    .site-header {
      line-height: 1;
      border-bottom: 1px solid #e5e5e5;
    }

    .site-header-logo {
      font-family: "Playfair Display", Georgia, "Times New Roman", serif;
      font-size: 2.25rem;
    }

    .site-header-logo:hover {
      text-decoration: none;
    }
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

    </style>
     <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <!-- Custom styles for this template -->
   <!--  <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('semantic/semantic.css') }}">
    <link href="{{ url('/css/rrssb.css') }}" rel="stylesheet">
 -->
    @yield('body_styles')
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css')}}">
     <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}"> 

    <link rel="stylesheet" href="{{ asset('css/lightgallery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    
    <link rel="stylesheet" href="{{ asset('fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    
     <link rel="stylesheet" type="text/css" href="{{ url('semantic/semantic.css') }}">
     <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <!-- page specific styles -->
    @yield('styles')
  </head>
  <body>
    <div class="pusher">
       <div class="container">
        @include('flash::message')
        
        @include('layouts.header')
        @include('layouts.nav')

        @yield('body_content')

        @yield('longtitle')
        @yield('topposts')
      <main role="main" class="container">

      @yield('content')

      </main>
      @include('partials._footer')
    </div>

<!-- <script src="/js/lightbox-plus-jquery.js"></script> -->
<!-- <script src="//code.jquery.com/jquery.js"></script> -->

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<!-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> -->
  <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>

  
 <!--  <script src="{{ asset('js/jquery-ui.js') }}"></script> -->
  <script src="{{ asset('js/popper.min.js') }}"></script>
  <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
  <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script> 
  
  <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('js/swiper.min.js')}}"></script>
  <script src="{{ asset('js/aos.js') }}"></script>
  <script src="{{ asset('js/picturefill.min.js') }}"></script>
  <script src="{{ asset('js/lightgallery-all.min.js') }}"></script>
  <script src="{{ asset('js/jquery.mousewheel.min.js') }}"></script> 
 
  <script src="{{ asset('js/main.js') }}"></script>

  <script src="/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
  <script src="{{ url('semantic/semantic.js') }}" ></script>
  @yield('scripts')

  @include('partials._google_analytics')
  
 
  
 <!--  <script>
    $(document).ready(function(){
      $('#lightgallery').lightGallery();
    });
  </script> -->
<script>
  $('#flash-overlay-modal').modal();
  $('div.alert').not('.alert-important').delay(3000).slideUp(300);

</script> 
</body>
</html>
