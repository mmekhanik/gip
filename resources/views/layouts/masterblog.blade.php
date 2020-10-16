<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(!empty(Settings::getMetaRobots()))
      <meta name="robots" content="{{ Settings::getMetaRobots() }}">
    @endif
    <!--facebook open graph-->
    <meta name="og:type" content="blog">
    <meta name="og:site_name" content="{{ config('app.name') }}">

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
       <!--favicon-->
     <!-- Favicons -->
      <link rel="apple-touch-icon" href="/img/apple-touch-icon.png" sizes="180x180">
      <link rel="icon" href="/img/favicon-32x32.png" sizes="32x32" type="image/png">
      <link rel="icon" href="/img/favicon-16x16.png" sizes="16x16" type="image/png">
      <!-- <link rel="manifest" href="/img/favicons/manifest.json"> -->
      <!-- <link rel="mask-icon" href="/img/safari-pinned-tab.svg" color="#563d7c"> -->
      <link rel="icon" href="/img/favicon.ico">
      <meta name="theme-color" content="#563d7c">
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

1
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script>
        var url = {!! json_encode(config("app.url")) !!};
        window.Blogger = {
            url : url
        }
         // console.log(window.Blogger);
    </script>
    
    <!-- Styles -->
    @yield('body_styles')
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('css/rrssb.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ url('semantic/semantic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
  
</head>

<body>
  <div class="container">
    @include('layouts.header')
    @include('layouts.nav')
    @yield('body_content')

    <!-- Scripts -->
     @yield('body_scripts')
    <script src="{{ url('js/app.js') }}" ></script>
    <script src="/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
    <script src="{{ url('semantic/semantic.js') }}" ></script>
     
    @yield('body_post_scripts')
    @include('partials._google_analytics')
  </div>
</body>
</html>
