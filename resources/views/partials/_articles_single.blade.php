@foreach($articles as $article)
<div class="ui card blogger-card fluid blue">
  <div class="content">
    <div class="right floated meta">{{ $article->published_at->diffForHumans()}}</div>
    <a href="{{url('about/'.$article->author->slug)}}"><img class="ui avatar mini image" src="{{(!empty($article->author->avatar))? url('/storage/images/avatars/'.$article->author->avatar) : url('images/avatars/avatar_default.png')}}">
        {{$article->author_name}} {{ (!empty($article->author->job))? ', '.$article->author->job : "" }}
    </a>
  </div><!--end of content-->

  <div class="content">
    <h2><a href="{{url('/article/'.$article->slug)}}">{{$article->title}}</a></h2>
    <div class="ui fluid image">

      <div class="ui blue ribbon label z-index-top">
        <a href="{{ url('categories/'.$article->category->slug) }}" class="white-font">{{$article->category_name}}</a>
      </div><!--end of category-name-->



      @if(Auth::check())
        <a class="ui right  skyblue corner label favorite" href="javascript:void(0)" data-id="{{ $article->id }}" data-content="Add to favourites" data-variation="inverted">
          <i class="{{($article->isFavourite())? 'yellow active': 'white'}} star icon"></i>
        </a>
      @endif
      @if(!empty($article->article_image))
         <div class="">
              <svg class="bd-placeholder-img card-img-top" width="640" height="480" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
              <title>{{ $article->title }}</title>
              <rect width="640" height="480" fill="#f2f5f7"/> 
              <a href="#" class="stretched-link">
                <image  class="ui fluid image lazy hoverable " width="100%" height="100%" x="0" y="0" xlink:href="{{ (!empty($article->article_image))? url(photo_thumbnail($article->article_image,config('blogger.filemanager.upload_path'))) : url('images/placeholder_640x480.png')}}" ></a>
            </svg>
            </div>
        @else
            <div style="margin-top:15px;height:50px; background: #ebf2fd"></div>
           
        @endif

    </div><!--end of image-->

  </div><!--end of content-->

  <div class="extra content">
  
  </div><!--end of content-->

</div><!--end of card-->
@endforeach

<div class="ui card blogger-card fluid no-box-shadow text-center">
  {{ $articles->links() }}
</div>
<!-- #3d5670; -->
<div class="ui card blogger-card fluid ">
  <div class="ui content text-center brand-blue">
    @include('partials._subscribe')
  </div>
</div>
