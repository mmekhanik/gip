@extends('layouts.master')
@section('title')
  · Blog
@endsection
@section('longtitle')
  <div class="jumbotron p-4 p-md-5 text-white rounded mailchimp">
    <div class="col-md-6 px-0 blog_hd">
      <h1 class="display-4 font-italic align-items-center">Blog</h1>
      <p class="lead my-3"><p>Made with ❤️ + Gipirion Inc</p>
    </div>
  </div>
@endsection
@section('topposts')
<div class="row mb-2">
   @if(count($recentPost)>0)
   <div class="col-md-12 blog-main">
   <h3 class="font-italic">Recent Posts</h3>
 </div>
   @foreach ($recentPost as $post)
    <div class="col-md-{{ $top_post_width }}">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
         <!--  @foreach($post->tags as $tag)
            <div><a href="/post/tag/{{ $tag->name }}">#{{ $tag->name }}</a></div>
          @endforeach -->
          <h3 class="mb-0"><a href="/posts/{{$post->slug }}">
                {{ str_limit($post->title, 30) }}</a> 
          </h3>
          <div class="mt-2">
          <p class="post-meta">
            By {{$post->user->name }} <br>
            on {{$post->created_at->toFormattedDateString()}} </a> 
          </p>
        </div> 
          <p class="card-text mb-auto">{!! str_limit(html_entity_decode($post->body, 130)) !!}</p>
          <a href="/post/{{ $post->slug }}" class="stretched-link">Continue reading</a>
          <!-- <a href="/post/{{ $post->slug }}" class="btn btn-sm btn-guide">Read More →</a> -->
        </div>
        <div class="col-auto d-none d-lg-block">
          <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#3d5670"/>
            <image width="200px" height="250px" href="/uploads/images/dacha/maki1.jpg" />
            <text x="50%" y="90%" fill="#eceeef" dy=".3em">Thumbnail
            </text>
          </svg>
        </div>
      </div>
    </div>
    @endforeach
    @endif
  </div>
</div>
@endsection
@section('content')
 <div class="row">
<div class="col-md-8 blog-main">
    @if($posts->isNotEmpty())
       @foreach($posts as $post)
	      <div class="blog-post">
	      	@include('posts.post')
	      </div><!-- /.blog-post -->
  		@endforeach
      
      {{ $posts->links() }} 
    @else
        <p>No Posts Found</p>   
    @endif
      
     <!--  <nav class="blog-pagination">
        <a class="btn btn-outline-primary" href="#">Older</a>
        <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>
      </nav> -->

    </div><!-- /.blog-main -->
     @include('layouts.blogside')
 </div><!-- /.row -->
@endsection

@section('subscribe')
<div id="subscribe" class="mailchimp mt-5">
  <div class="container text-center">
    <div class="row justify-content-center">
      <div class="col-xl-7 col-lg-8">
        <p class="text-white-50 blog-description pb-3">Never miss an update. Subscribe now!  </p>
        <div id="mc_embed_signup">
          <div class="input-group input-group-lg">
            <input class="form-control border-0" id="mce-EMAIL" placeholder="Email address...">
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