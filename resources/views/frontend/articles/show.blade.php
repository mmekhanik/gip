@extends(config('blogger.article_layout'),[
  'meta_keywords' => $article->meta_keywords,
  'meta_description' => $article->meta_description,
])

@section('title', $article->title)

@section('og-title')
  <meta property="og:title" content="{{ $article->title }}"/>
@stop

@section('og-description')
  <meta property="og:description" content="{{ $article->meta_description }}"/>
@stop

@section('styles')
  <link href="/css/lightbox.css" rel="stylesheet">
@stop

@if(!empty($article->article_image))
    @section('og-image')
      <meta property="og:image" content="{{ url(config('blogger.filemanager.upload_path').'/'.$article->article_image) }}">
    @stop
@endif

@section('content')
<div class="ui segments raised">

  <div class="ui segment">
    {!! Breadcrumbs::render('frontend.articles.show', $article) !!}
  </div><!--end of segment-->

  <div class="ui segment blue">

      @if($article)
      <article>
        <header>
          <div class="ui divided items">

          <div class="item item-article">

            <a class="ui avatar-sm item-image" href="{{ url('about/'.$article->author->slug) }}">
                 <img class="ui avatar-sm" src="{{(!empty($article->author->avatar))? url('/storage/images/avatars/'.$article->author->avatar) : url('images/avatars/avatar_default.png')}}">
            </a>

            <div class="middle aligned content">
                  <a class="ui header item-mute" href="{{ url('about/'.$article->author->slug) }}">{{ $article->author_name }}</a>
                  <div><strong>{{ (!empty($article->author->job))? $article->author->job : "Editor" }}</strong></div>
                  <div class="item-mute"><i class="clock icon"></i>{{ $article->reading_time}} | {{ $article->published_at->diffForHumans()}}</div>

            </div>
                  @if(Auth::user() && (($article->author_id==Auth::user()->id) || Auth::user()->hasRole('superadministrator|administrator')))
            <div class="middle aligned content ">
              <a class="ui right floated tiny primary icon button no-wrap"  href="{{ url('dashboard/articles/'.$article->id.'/edit') }}">
                  <i class="edit icon"></i> Edit
              </a>
            </div>
            @endif
          </div>
          </div>
            <h1 class="article-title"><a href="">{{ $article->title }}</a></h1>
        </header>

        <div class="article-content">
         <div class="ui fluid image">
                 <div class="ui blue big ribbon label z-index-top">
                    <a href="{{ url('categories/'.$article->category->slug) }}" class="white-font">{{$article->category_name}}</a>
                </div>
                @if(Auth::user())
                <a class="ui right  blue corner label favorite" href="javascript:void(0)" data-id="{{ $article->id }}" data-content="Add to favourites" data-variation="inverted">
                  <i class="{{($article->isFavourite())? 'yellow active ': 'white '}}star icon"></i>
                </a>
                @endif
                @if(!empty($article->article_image))
                  <svg class="bd-placeholder-img" width="100%" height="640" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Admin">
                    <title>{{ $article->title }}</title>
                    <rect width="100%" height="640px" fill="#fff"/>
                     <a class="example-image-link" href="{{ (!empty($article->article_image))? url(photo_thumbnail($article->article_image,config('blogger.filemanager.upload_path'))) : url('images/placeholder_640x480.png')}}" data-lightbox="example-set" data-title=""><image width="100%" height="640px" href="{{ (!empty($article->article_image))? url(photo_thumbnail($article->article_image,config('blogger.filemanager.upload_path'))) : url('images/placeholder_640x480.png')}}" /></a>
                  
                  </svg>
                @else
                   <div style="margin-top:15px;height:50px; background: #ebf2fd"></div>
                @endif
          </div>
          {!!html_entity_decode($article->html_content)!!}

        </div>

        <footer>
          <div class="article-share">
              <h4>Share:</h4>
             @include('partials._share_buttons',['article' => $article])
          </div>
          <br />
          <div class="article-tags">
            <h4>Tags:</h4>
            @foreach($article->tags as $tag)
             <a class="ui large blue label" href="{{ url('tags/'.$tag->slug) }}">{{ $tag->name }}</a>
            @endforeach
          </div>
          <br />
          @include('partials._disqus',['url'=>url('article/'.$article->slug), 'identifier' => $article->id])
        </footer>

      </article>
      @endif


    </div><!--end of segment-->
</div><!--end of segments-->
@if($relatedArticles && count($relatedArticles) > 0)
<div class="ui segments raised center">
  <div class="ui segment">
  <h2><i class="empty heart icon"></i> Related reads</h2>
  <div class="ui relaxed grid">
      <div class="three column row stackable">
        @foreach($relatedArticles as $article)
        <div class="column text-center">
           <a href="{{url('article/'.$article->slug)}}">
            <div class="ui card">
              <div class="content content-limit">{{str_limit($article->title, $limit = 50, $end = '...')}}</div>
              @if(!empty($article->article_image))
              <div class="image">
                 <img class="ui image floated" src="{{ (!empty($article->article_image))? url(photo_thumbnail($article->article_image,config('blogger.filemanager.upload_path'))) : ""}}" alt="" />
              </div>
            
              @endif
              <div class="content">

                <img class="ui avatar mini image" src="{{(!empty($article->author->avatar))? url('/storage/images/avatars/'.$article->author->avatar) : url('images/avatars/avatar_default.png')}}"> {{$article->author->display_name}}
              </div>

              <div class="extra content">
                     <div class="item-mute"><i class="clock icon"></i>{{ $article->reading_time}}  |  {{ $article->published_at->diffForHumans()}}</div>
              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>
  </div>
  </div>
</div><!--end of segments-->
@endif
@endsection


@section('scripts')
  <script src="/js/lightbox-plus-jquery.js"></script>
@stop
