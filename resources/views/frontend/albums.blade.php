@extends('layouts.frontend')

@section('title', 'Gallery'.$name)

@section('styles')
    <!-- Custom styles for this template -->
   <!--  <link rel="stylesheet" href="fonts/icomoon/style.css"> -->
    
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css')}}">
     <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}"> 

    <link rel="stylesheet" href="{{ asset('css/lightgallery.min.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}"> -->
    
    <link rel="stylesheet" href="{{ asset('fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="/css/album.css" rel="stylesheet">
    <link href="/css/lightbox.css" rel="stylesheet">
@stop

@section('nav_top')
    @include('partials._nav_top_albums')    
@endsection

@section('content')

<!--   <div class="album py-0 bg-light">
    <div class="container">
      <div class="row rounded overflow-hidden flex-md-row  position-relative">
        <div class="col-md-6 col d-flex flex-column position-static">
            <h1 style="color: #3d5670;"  class="display-4 font-italic align-items-center">Albums</h1>
        </div>
        <div class="col-md-6 col-auto d-flex flex-column">
            <div class="form-group  bg-white ">
                
               <select class="form-control" name="album_id" onchange="top.location.href = this.options[this.selectedIndex].value">
                    <option value="{{ route('albums') }}" {{ (empty($album_id)) ? 'selected' : '' }}>Select All</option>
                        @if (count($sorted_albums) > 0)

                            @foreach ($sorted_albums as $album)
                                {{ $data['album'] = $album }}
                                <option  value="{{ 

                                route('albums', ['album_id'=>$album->id]) }}" {{ ($album_id==$album->id) ? 'selected' : '' }}>{{ $album->name }}</option>
                            @endforeach
                                
                        @endif
                </select>
          </div> 
        </div>
      </div> --> 

<div class="row">
    @for ($i = 0; $i < count($albums); $i++)
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="230" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
              <title>{{ $albums[$i]->name }}</title>
              <rect width="100%" height="100%" fill="#f2f5f7"/> 
              <a href="{{ route('gallery',$albums[$i]->slug) }}" class="stretched-link"><image width="100%" height="100%" x="0" y="0" xlink:href="{{ (!empty($albums[$i]->banner))? url(photo_thumbnail($albums[$i]->banner,config('blogger.filemanager.upload_path'))) : "" }}" alt="{{ $albums[$i]->name }}"/></a>
              <!-- <text x="50%" y="90%" fill="#eceeef" dy=".3em">{{ $albums[$i]->banner }}</text> -->
            </svg>
            <div class="card-body">

                <h4 class="mb-3">{{ $albums[$i]->name }}</h4>
                <small> # of Photos:  
                  @if(!empty($photos[$albums[$i]->id]))
                    {{ $photos[$albums[$i]->id]->count() }}
                  @else
                    0
                  @endif 
                </small>
              <div class="d-flex justify-content-between align-items-center">
                
                <div class="btn-group">
                   <a class="btn btn-sm btn-outline-secondary" href="{{ route('gallery',$albums[$i]->slug) }}" class="btn py-2 px-4">View Photos</a>
                    
                </div>
                <small class="text-muted">{{$albums[$i]->created_at->diffForHumans()}} </small>
              </div>
            </div>
          </div>
        </div>
      @endfor
    </div> <!-- row -->
    @if(count($albums)>1)
     {{ $albums->links() }} 
    @endif

    </div>
  </div>

@endsection

@section('scripts')
  <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
  <script src="{{ asset('js/popper.min.js') }}"></script>
  <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
  <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script> 
  
  <!-- <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script> -->
  <script src="{{ asset('js/swiper.min.js')}}"></script>
  <script src="{{ asset('js/aos.js') }}"></script>
  <script src="{{ asset('js/picturefill.min.js') }}"></script>
  <script src="{{ asset('js/lightgallery-all.min.js') }}"></script>
  <script src="{{ asset('js/jquery.mousewheel.min.js') }}"></script> 
 
  <script src="{{ asset('js/main.js') }}"></script>
   <script src="/js/lightbox-plus-jquery.js"></script>
  <script>

    $(document).ready(function(){
      console.log('albums');
      // $('#lightgallery').lightGallery();
    });
  </script>

@stop
