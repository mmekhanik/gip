@extends('layouts.backend')

@section('title')
  @if(!empty($album))
    Album - Update
  @else
    Album - Create
  @endif
@stop
@section('content')

<div class="ui segment large">
  @if(!empty($album))
    {!! Breadcrumbs::render('backend.albums.edit',$album) !!}
  @else
    {!! Breadcrumbs::render('backend.albums.create') !!}
  @endif
</div><!--end of segment-->

<div class="ui segment teal padded">

  @if(!empty($album))
  <h2>Update an Album</h2>
  <form class="ui form" method="POST" action="{{url('dashboard/albums/'.$album->id) }}">
  {{method_field('PUT')}}
  @else
  <h2>Create an Album</h2>
  <form class="ui form" method="POST" action="{{url('dashboard/albums')}}">

  @endif
  @csrf

  @include('partials._errors')
  @include('partials._success',['flashSuccess'=>'status'])

  <div class="field fluid {{ $errors->has('name') ? 'error' : '' }}">
    <label for="album-name">Title</label>
    <div class="ui input">
      <input type="text" name="name" id="album-name" placeholder="Title" value="{{  ($album->name) ?? old('name') }}" >
    </div>
  </div>
  <div class="field fluid {{ $errors->has('slug') ? 'error' : '' }}">
    <label for="album-slug">Slug</label>
    <div class="ui input">
      <input type="text" name="slug" id="album-slug" placeholder="Slug" value="{{ ($album->slug) ?? old('slug') }}" >
    </div>
  </div>
  <div class="field">
    <label for="album-image">Album Image</label>
    <div class="ui left action input">
    <button class="ui teal labeled icon button" class="pick-image" id="album-pick-image">
          <i class="image icon"></i>
          Pick Image
      </button>
      <input type="text" name="album_image" id="album-image-path" value="{{($album->banner) ?? old('album') }}" placeholder="relative image url">
    </div>

    <div class="ui segment left floated segment-margin">
      <div id="album-image-preview" class="ui medium bordered image">
        <img  src="{{ (isset($album) && $album->banner)? url(config('blogger.albummanager.upload_path').'/'.$album->banner): "" }}" height="5rem">
      </div>
    </div>
  </div>
  <button class="ui fluid fluid primary submit button" type="submit" name="submit">
    @if(!empty($album))
      Update
    @else
      Create
    @endif
    Album
   </button>    
  </form>
</div><!--end of segment-->
</div>
@endsection

@section('scripts')
   @include('partials._album_manager_scripts')
@stop
