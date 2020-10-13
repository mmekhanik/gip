@extends('layouts.master')
@section('pagespecificstyles')
  <link href="/css/lightbox.css" rel="stylesheet">
@stop
@section('longtitle')
  <div class="jumbotron p-4 p-md-5 text-white rounded mailchimp">
    <div class="col-md-6 px-0 blog_hd">
      <h1 class="display-4 font-italic align-items-center">About Us</h1>
    </div>
  </div>
@endsection

@section('content')
<div class="col-md-12">
  <section>
  <h3 class="pb-4 mb-4 font-italic border-bottom">Team</h3>
  <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
    <div class=" position-static d-none d-lg-block">
      <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Admin">
        <title>Marina</title>
        <rect width="100%" height="100%" fill="#3d5670"/>
        <image width="200px" height="250px" href="/uploads/images/team/marina.jpg" />
        <text x="50%" y="90%" fill="#eceeef" dy=".1em">
        </text>
      </svg>
    </div>
    <div class="col p-4 d-flex flex-column col-auto ">
      <strong class="d-inline-block mb-2 text-primary">Admin</strong>
      <h3 class="mb-0">Marina</h3>
      <div class="mb-1 text-muted">Nov 11</div>
      <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
      <a href="#" class="stretched-link">Continue reading</a>
    </div>
  </div>
  <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
    <div class=" position-static d-none d-lg-block">
      <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Admin">
        <title>Yuri</title>
        <rect width="100%" height="100%" fill="#3d5670"/>
        <image width="200px" height="250px" href="/uploads/images/team/yura.jpg" />
        <text x="50%" y="90%" fill="#eceeef" dy=".3em">
        </text>
      </svg>
    </div>
    <div class="col p-4 d-flex flex-column col-auto ">
      <strong class="d-inline-block mb-2 text-success">Admin</strong>
      <h3 class="mb-0">Yuri</h3>
      <div class="mb-1 text-muted">Nov 11</div>
      <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
      <a href="#" class="stretched-link">Continue reading</a>
    </div>
  </div>
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
    <div class=" position-static d-none d-lg-block">
      <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Admin">
        <title>Valera</title>
        <rect width="100%" height="100%" fill="#3d5670"/>
        <image width="200px" height="250px" href="/uploads/images/team/valera.jpg" />
        <text x="50%" y="90%" fill="#eceeef" dy=".3em">
        </text>
      </svg>
    </div>
    <div class="col p-4 d-flex flex-column col-auto ">
      <strong class="d-inline-block mb-2 text-primary">Admin</strong>
      <h3 class="mb-0">Valera</h3>
      <div class="mb-1 text-muted">Nov 11</div>
      <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
      <a href="#" class="stretched-link">Continue reading</a>
    </div>
  </div>
  <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
    <div class=" position-static d-none d-lg-block">
      <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Admin">
        <title>Marc</title>
        <rect width="100%" height="100%" fill="#3d5670"/>
        <image width="200px" height="250px" href="/uploads/images/team/marc.jpg" />
        <text x="50%" y="90%" fill="#eceeef" dy=".3em">
        </text>
      </svg>
    </div>
    <div class="col p-4 d-flex flex-column col-auto ">
      <strong class="d-inline-block mb-2 text-success">Admin</strong>
      <h3 class="mb-0">Marc</h3>
      <div class="mb-1 text-muted">Nov 11</div>
      <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
      <a href="#" class="stretched-link">Continue reading</a>
    </div>
  </div>
</section>
</div>
<div class="col-md-12 px-0">
  <div class="album py-5 bg-light">
    <div class="container">
     <div class="row">
	     <div class="col-md-6">
	     	<h3>Villa 41 </h3>
	     </div>
	     <div class="col-md-6">
	     	<h4><a href="/uploads/images/villa41/pdf/villa41.pdf" target="_blank">Architectural Plans (.pdf)</a></h4>
	    </div>
	</div>
    <div class="row">
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
       		<a class="example-image-link" href="/uploads/images/villa41/1.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img class="album_thumb_image" src="/uploads/images/villa41/1.jpg" alt=""/></a>
	         	<div class="card-body">
	              <p class="card-text">Front 3D</p>
	            </div>
          </div>
        </div>
       <div class="col-md-4">
          	<div class="card mb-4 shadow-sm">
	       		<a class="example-image-link" href="/uploads/images/villa41/2.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img class="album_thumb_image" src="/uploads/images/villa41/2.jpg" alt=""/></a>
	       		<div class="card-body">
	              <p class="card-text">Back 3D</p>
	            </div>
	       </div>
        </div>
       <div class="col-md-4">
	        <div class="card mb-4 shadow-sm">
	       		<a class="example-image-link" href="/uploads/images/villa41/3.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img class="album_thumb_image" src="/uploads/images/villa41/3.jpg" alt=""/></a>
	       		<div class="card-body">
	              <p class="card-text">Left Side 3D</p>
	            </div>
	        </div>
        </div>
       
    </div>
    <div class="row">

       <div class="col-md-4">
          	<div class="card mb-4 shadow-sm">
	       		<a class="example-image-link" href="/uploads/images/villa41/4.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img class="album_thumb_image" src="/uploads/images/villa41/4.jpg" alt=""/></a>
	      		<div class="card-body">
	              <p class="card-text">Right Side 3D</p>
	            </div>
	      	</div>
        </div>
        <div class="col-md-4">
           <div class="card mb-4 shadow-sm">
	       	<a class="example-image-link" href="/uploads/images/villa41/bedroom1_0.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img class="album_thumb_image" src="/uploads/images/villa41/bedroom1_0.jpg" alt=""/></a>
	       	<div class="card-body">
	              <p class="card-text">Bedroom 1</p>
	            </div>
	       </div>
        </div>
       <div class="col-md-4">
          	<div class="card mb-4 shadow-sm">
       			<a class="example-image-link" href="/uploads/images/villa41/kitchen_0.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img class="album_thumb_image" src="/uploads/images/villa41/kitchen_0.jpg" alt=""/></a>
          		<div class="card-body">
	              <p class="card-text">Kitchen</p>
	            </div>
          	</div>
        </div>
    </div>
    <div class="row">

       <div class="col-md-4">
          	<div class="card mb-4 shadow-sm">
	       		<a class="example-image-link" href="/uploads/images/villa41/livingroom1.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img class="album_thumb_image" src="/uploads/images/villa41/livingroom1.jpg" alt=""/></a>
	      		<div class="card-body">
	              <p class="card-text">Living Room</p>
	            </div>
	      	</div>
        </div>
        <div class="col-md-4">
           <div class="card mb-4 shadow-sm">
	       	<a class="example-image-link" href="/uploads/images/villa41/fan1.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img class="album_thumb_image" src="/uploads/images/villa41/fan1.jpg" alt=""/></a>
	       	<div class="card-body">
	              <p class="card-text">Fan Samples</p>
	            </div>
	       </div>
        </div>
       	<div class="col-md-4">
          	<div class="card mb-4 shadow-sm">
       			<a class="example-image-link" href="/uploads/images/villa41/fan2.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img class="album_thumb_image" src="/uploads/images/villa41/fan2.jpg" alt=""/></a>
          		<div class="card-body">
	              <p class="card-text">Fan Ruslan/Alya</p>
	            </div>
          	</div>
        </div>
    </div> <!-- row -->
    <h3>Dacha Galya</h3>
    <div class="row">
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
       		<a class="example-image-link" href="/uploads/images/dacha/maki1.jpg" data-lightbox="example-set-dacha" data-title="Click the right half of the image to move forward."><img class="album_thumb_image" src="/uploads/images/dacha/maki1.jpg" alt=""/></a>
	         	<div class="card-body">
	              <p class="card-text">Маки</p>
	            </div>
          </div>
        </div>
       <div class="col-md-4">
          	<div class="card mb-4 shadow-sm">
	       		<a class="example-image-link" href="/uploads/images/dacha/maki2.jpg" data-lightbox="example-set-dacha" data-title="Click the right half of the image to move forward."><img class="album_thumb_image" src="/uploads/images/dacha/maki2.jpg" alt=""/></a>
	       		<div class="card-body">
	              <p class="card-text">Маки</p>
	            </div>
	       </div>
        </div>
       <div class="col-md-4">
	        <div class="card mb-4 shadow-sm">
	       		<a class="example-image-link" href="/uploads/images/dacha/maki3.jpg" data-lightbox="example-set-dacha" data-title="Click the right half of the image to move forward."><img class="album_thumb_image" src="/uploads/images/dacha/maki3.jpg" alt=""/></a>
	       		<div class="card-body">
	              <p class="card-text">Маки</p>
	            </div>
	        </div>
        </div>
       
    </div>
    <div class="row">

       <div class="col-md-4">
          	<div class="card mb-4 shadow-sm">
	       		<a class="example-image-link" href="/uploads/images/dacha/iris1.jpg" data-lightbox="example-set-dacha" data-title="Click the right half of the image to move forward."><img class="album_thumb_image" src="/uploads/images/dacha/iris1.jpg" alt=""/></a>
	      		<div class="card-body">
	              <p class="card-text">Ирисы</p>
	            </div>
	      	</div>
        </div>
        <div class="col-md-4">
           <div class="card mb-4 shadow-sm">
	       	<a class="example-image-link" href="/uploads/images/dacha/iris2.jpg" data-lightbox="example-set-dacha" data-title="Click the right half of the image to move forward."><img class="album_thumb_image" src="/uploads/images/dacha/iris2.jpg" alt=""/></a>
	       	<div class="card-body">
	              <p class="card-text">Ирисы</p>
	            </div>
	       </div>
        </div>
       <div class="col-md-4">
          	<div class="card mb-4 shadow-sm">
       			<a class="example-image-link" href="/uploads/images/dacha/iris3.jpg" data-lightbox="example-set-dacha" data-title="Click the right half of the image to move forward."><img class="album_thumb_image" src="/uploads/images/dacha/iris3.jpg" alt=""/></a>
          		<div class="card-body">
	              <p class="card-text">Нарцисы</p>
	            </div>
          	</div>
        </div>
    </div>
    <div class="row">

       <div class="col-md-4">
          	<div class="card mb-4 shadow-sm">
	       		<a class="example-image-link" href="/uploads/images/dacha/dom1.jpg" data-lightbox="example-set-dacha" data-title="Click the right half of the image to move forward."><img class="album_thumb_image" src="/uploads/images/dacha/dom1.jpg" alt=""/></a>
	      		<div class="card-body">
	              <p class="card-text">Дом</p>
	            </div>
	      	</div>
        </div>
        <div class="col-md-4">
           
        </div>
       	<div class="col-md-4">
          	
        </div>
    </div> <!-- row -->
   </div> <!-- container -->
</div> <!-- album -->
</div>

@endsection

@section('pagespecificscripts')
    <script src="/js/lightbox-plus-jquery.js"></script>
    <script>
    // var editor = new Simditor({
    //     textarea: $('#blogeditor')
    //     //optional options
    // });
    $(document).ready(function(){
      console.log('about');
    });
  </script>
@stop