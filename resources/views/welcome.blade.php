@extends('layouts.frontend')

@section('title', 'Giprioin Inc.')

@section('styles')
    <link href="/css/lightbox.css" rel="stylesheet">
    <link href="/css/carousel.css" rel="stylesheet">
     <style>
    .carousel img {
    max-height: 200px;
    margin: 0 auto;
  </style>
}
@stop
@section('nav_top')
    @include('partials._home_carusel')    
@endsection

@section('content')

  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

    <!-- Three columns of text below the carousel -->
     @if(isset($articles) && count($articles))
      <div class="row">
        @foreach($articles as $article)
          <div class="col-lg-4">
            <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140">
              <title>Placeholder</title>
              <rect width="100%" height="100%" fill="#3d5670">    
              </rect>
              <image width="140px" height="190px" href="{{ (!empty($article->article_image))? url(photo_thumbnail($article->article_image,config('blogger.filemanager.upload_path'))) : url('images/placeholder_640x480.png')}}" />
            </svg>
          <h2>{{ str_limit($article->title, $limit = 50, $end = '...') }}</h2>
          <p>{{'Author: '.$article->author_name . ' at '. $article->created_at->format('d M Y')}}</p>
          <p>
          <a class="btn btn-secondary" href="{{url('/article/'.$article->slug)}}" role="button">View details &raquo;</a></p>
      </div><!-- /.col-lg-4 -->

        @endforeach
      </div><!-- /.row -->
    @endif

    <!-- START THE FEATURETTES -->
    @if (count($ourservices) > 0)
      @for ($i = 0; $i < count($ourservices); $i=$i+2)
        <hr class="featurette-divider">
        @if(isset($ourservices[$i]))
        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">{{ $ourservices[$i]->title  }} <span class="text-muted">{{ $ourservices[$i]->subtitle  }}</span></h2>
            <p class="lead">{!!
                        $ourservices[$i]->description
                        !!}</p>
          </div>
          
            <div class="col-md-5 order-md-1">
              <svg class="bd-placeholder-img card-img-top" width="350" height="350" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
              <title>{{ $ourservices[$i+1]->title }}</title>
              <rect width="350" height="350" fill="#f2f5f7"/> 
              <a href="#" class="stretched-link"><image width="100%" height="100%" x="0" y="0" xlink:href="{{ (!empty($ourservices[$i]->thumbnail))? url(photo_thumbnail($ourservices[$i]->thumbnail,config('blogger.filemanager.upload_path'))) : url('images/placeholder_640x480.png')}}" ></a>
            </svg>
            </div>
          </div>
        </div>
        @endif
        @if(isset($ourservices[$i+1]))
        <hr class="featurette-divider">

          <div class="row featurette">
            <div class="col-md-7 order-md-2">
              <h2 class="featurette-heading">{{ $ourservices[$i+1]->title  }} <span class="text-muted">{{ $ourservices[$i+1]->subtitle  }}</span></h2>
              <p class="lead">{!!
                        $ourservices[$i+1]->description
                        !!}</p>
            </div>
            <div class="col-md-5 order-md-1">
              <svg class="bd-placeholder-img card-img-top" width="350" height="350" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
              <title>{{ $ourservices[$i+1]->title }}</title>
              <rect width="350" height="350" fill="#f2f5f7"/> 
              <a href="#" class="stretched-link"><image width="100%" height="100%" x="0" y="0" xlink:href="{{ (!empty($ourservices[$i+1]->thumbnail))? url(photo_thumbnail($ourservices[$i+1]->thumbnail,config('blogger.filemanager.upload_path'))) : url('images/placeholder_640x480.png')}}" ></a>
            </svg>
             
            </div>
          </div>
          @endif
      @endfor
    <hr class="featurette-divider">
    @endif
    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->
 @endsection

@section('subscribe')
<div id="subscribe" class="mailchimp mt-5">
  <div class="container text-center">
    <div class="row justify-content-center">
       <div class="col-xl-7 col-lg-8">
        <p class="text-white-50 blog-description pb-3">Never miss an update. Subscribe now!  </p>
      <div id="mc_embed_signup">
           <div class="input-group input-group-lg">
           s<input class="form-control border-0" id="mce-EMAIL" placeholder="Email address..."/>
              <div class="input-group-append">
                <button class="btn btn-light">Subscribe!</button>
              </div>
          </div>
        </div> 
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
    <script src="/js/lightbox-plus-jquery.js"></script>
    <script>

    $(document).ready(function(){
      console.log('welcome');
    });
  </script>
@stop
