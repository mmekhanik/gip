@extends('layouts.master')
@section('pagespecificstyles')
<link rel="stylesheet" type="text/css" href="/assets/styles/simditor.css" /> 
@stop
@section('content')
<div class="col-md-8 blog-main container">
	<h1>Publish a Post</h1>
	<hr>
	<form method="POST" action="/post">
		{{ csrf_field() }}
	  <div class="form-group">
	    <label for="title">Title</label>
	    <input type="text" class="form-control" id="title" name="title" placeholder="Title">
	  </div>
	  <div class="form-group">
	    <label for="body">Body</label>
	    <textarea id="blogeditor" name="body" class="form-control" ></textarea>
	  </div>
	  <div class="form-group">
        <label for="title">Tags</label>
        <input type="text" class="form-control" id="tags" name="tags">
      </div>
	  <div class="form-group">
	  	<button type="submit" class="btn btn-primary">Publish</button>
	  </div>
	</form>
	@include('layouts.errors')
	
</div>
@endsection

@section('pagespecificscripts')
    <script type="text/javascript" src="/assets/scripts/module.js"></script>
    <script type="text/javascript" src="/assets/scripts/hotkeys.js"></script>
    <script type="text/javascript" src="/assets/scripts/uploader.js"></script>
    <script type="text/javascript" src="/assets/scripts/simditor.js"></script>
    <script>
    $(document).ready(function(){
    	console.log('blog');
      // Simditor.locale = 'en-US';
      var editor = new Simditor({
        textarea: $('#blogeditor')
        //optional options
      });
    });
  </script>
@stop