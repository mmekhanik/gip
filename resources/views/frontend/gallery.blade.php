
@extends('layouts.frontend')

@section('title', 'Album - '.$title)

@section('nav_top')
      @include('partials._nav_top_albums')   
@endsection


@section('styles')
   <!-- Custom styles for this template -->
    <!-- <link rel="stylesheet" href="fonts/icomoon/style.css"> -->
    
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css')}}">
     <!-- <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}"> 

    <link rel="stylesheet" href="{{ asset('css/lightgallery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    
    <link rel="stylesheet" href="{{ asset('fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@stop

@section('content')
<main role="main" class="container">
  <div class="bg-white"  data-aos="fade">
    
  <div class="container-fluid">
      <div class="row" id="lightgallery">
        @if (count($photos) > 0)
            @foreach ($photos as $photo)

            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" 
            data-aos="fade" 
            data-src="{{ (!empty($photo->image))? url(photo_thumbnail($photo->image,config('blogger.filemanager.upload_path'))) : ""  }}" 
            data-sub-html="<h4>{{ $photo->title}}</h4><p>{!! $photo->description !!}</p>">
                
            <a href="#">
                    <img src="{{ (!empty($photo->image))? url(photo_thumbnail($photo->image,config('blogger.filemanager.upload_path'))) : ""  }}" alt="IMage" class="img-fluid">
                </a>
              </div>
                      
            @endforeach
        @endif
      </div>
    </div>
  </div>
  </main>
@endsection

@section('post_scripts')
  <!-- <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script> -->
  <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
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

  <script>
    $(document).ready(function(){
      console.log('galery');
      $('#lightgallery').lightGallery();
    });
  </script>

@stop