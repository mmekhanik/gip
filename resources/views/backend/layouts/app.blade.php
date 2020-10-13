<!DOCTYPE html>
<html lang="en">
  <head>
    <title>{{setting('site_title')}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="/bootstrap-4.5.0-dist/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
   <link rel="stylesheet" href="{{ asset('backend/css/app.css') }}">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/navbar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('semantic/semantic.css') }}">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
   <!--  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> -->
        <!-- Favicons -->
    <link rel="apple-touch-icon" href="/img/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/img/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/img/favicon-16x16.png" sizes="16x16" type="image/png">
    <!-- <link rel="manifest" href="/img/favicons/manifest.json"> -->
    <!-- <link rel="mask-icon" href="/img/safari-pinned-tab.svg" color="#563d7c"> -->
    <link rel="icon" href="/img/favicon.ico">
  </head>
  <body>
  <div class="container-fluid">
    <div class="site-wrap">

        
    @include('layouts.header')
    @include('layouts.nav')
    
    @include('backend.layouts.partials.sidebar')

    <div id="content-wrapper">
  
        <div class="container-fluid">

  
  
    @yield('content')


    
        
              </div>
              <!-- /.content-wrapper -->
        
            </div>
            <!-- /#wrapper -->
  </div>     
  <script src="{{ asset('backend/js/app.js') }}"></script> 
  <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
  <script src="{{ asset('js/jquery-ui.js') }}"></script>
  <script src="{{ asset('js/popper.min.js') }}"></script>
   <script src="{{ url('semantic/semantic.js') }}" ></script>
  
  </body>
</html>