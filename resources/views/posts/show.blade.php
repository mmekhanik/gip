@extends('layouts.master')
@section('pagespecificstyles')
<link rel="stylesheet" type="text/css" href="/assets/styles/simditor.css" /> 
@stop

@section('content')
<div class="col-sm-8 blog-main">
	<h1> {{ $post->title }} </h1>
	   @if(count($post->tags))
	        @foreach($post->tags as $tag)
	           <a href="/post/tag/{{ $tag->name }}">
	            #{{ $tag->name }}</a> 
	        @endforeach
	    <br>
        @endif
     <div class="mt-2">
          <p class="post-meta">
            <strong>By <a href="#">{{$post->user->name }}</a>&nbsp;
            on {{$post->created_at->toFormattedDateString()}} </strong> 
          </p>
        </div>
	{!! html_entity_decode($post->body) !!} 
	 {!! html_entity_decode($post->body) !!}
	<div id="postbody">
	</div>

	<div class="comments">
		<div class="list-group">
		@foreach($post->comments as $comment)
			<li class="list-group-item">

				<strong>
					<a href="#">{{$comment->user->name }}</a>&nbsp;
					{{ $comment->created_at->diffForHumans() }}:&nbsp;
				</strong>
				{{ $comment->body }}
				
			</li>	
		@endforeach
		</div>
	</div>
	<hr/>
	<div class="card">
		<div class="card-block">
			<form method="POST" action="/post/{{ $post->slug }}/comments">
				{{ csrf_field() }}
				<!-- {{ method_field('PATCH') }} -->
				<div class="form-group">
					<textarea name="body" placeholder="Your comment here" class="form-control" required>
					</textarea>
				</div>
				<div class="form-group">
				  	<button type="submit" class="btn btn-primary">Add Comment</button>
				</div>
			</form>
			@include('layouts.errors')
		</div>
	
	</div>
</div>
@endsection

@section('pagespecificscripts')
    <script type="text/javascript" src="/assets/scripts/module.js"></script>
    <script type="text/javascript" src="/assets/scripts/hotkeys.js"></script>
    <script type="text/javascript" src="/assets/scripts/uploader.js"></script>
    <script type="text/javascript" src="/assets/scripts/simditor.js"></script>
    <script>
    $(document).ready(function(){
    	console.log('show blog');
    });
  </script>
@stop