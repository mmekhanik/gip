@extends('layouts.backend')

@section('title')
  @if(!empty($photo))
    Photo - Update
  @else
    Photo - Create
  @endif
@stop

@section('content')
<div class="ui segment large">
@if(!empty($photo))
  {!! Breadcrumbs::render('backend.photos.edit',$photo) !!}
@else
  {!! Breadcrumbs::render('backend.photos.create') !!}
@endif
</div><!--end of segment-->

<div class="ui segment teal padded">

  @if(!empty($photo))
  <h2>Update Photo</h2>
  <form class="ui form" method="POST" action="{{url('dashboard/photos/'.$photo->id) }}">
  {{method_field('PUT')}}
  @else
  <h2>Create an Album</h2>
  <form class="ui form" method="POST" action="{{url('dashboard/photos')}}">

  @endif
  @csrf

  @include('partials._errors')
  @include('partials._success',['flashSuccess'=>'status'])

  <div class="field fluid {{ $errors->has('title') ? 'error' : '' }}">
    <label for="photo-title">Title</label>
    <div class="ui input">
      <input type="text" name="title" id="photo-title" placeholder="Title" value="{{  ($photo->title) ?? old('title') }}" >
    </div>
  </div>
   <div class="field fluid {{ $errors->has('album') ? 'error' : '' }}">
    <label>Albums</label>
    <select class="ui dropdown" name="album_id" value="{{ old('album_id')}}">
      <option value="">Album</option>
      @if(isset($sorted_albums))
        @foreach($sorted_albums as $album)
          @if((!empty($photo) && $photo->album_id == $album->id) || old('album_id') == $album->id)
                <option value="{{ $album->id }}" selected>{{$album->name}} </option>
          @else
                <option value="{{ $album->id }}">{{$album->name}} </option>
          @endif
        @endforeach
      @endif
    </select>
  </div>
  <div class="field">
    <label for="photo-image">Photo Image</label>
    <div class="ui left action input">
    <button class="ui teal labeled icon button" id="photo-pick-image">
          <i class="image icon"></i>
          Pick Image
      </button>
      <input type="text" name="photo_image" id="photo-image-path" value="{{($photo->image) ?? old('photo') }}" placeholder="relative image url">
    </div>

    <div class="ui segment left floated segment-margin">
      <div id="photo-image-preview" class="ui medium bordered image">
        <img  src="{{ (isset($photo) && $photo->image)? url(photo_thumbnail($photo->image,config('blogger.filemanager.upload_path'))): "" }}" height="5rem">
      </div>
    </div>
</div>
    <div class="field {{ $errors->has('description') ? 'error' : '' }}">
        <label for="photo-content">Description</label>
        <textarea id="photo-content"  class="service-content" name="description">{{ ($photo->description) ?? old('description') }}</textarea>
    </div>
    @if(!empty($photo))
    <div class="field">
      <label for="owner">Owner</label>
        <div class="ui input">
            <input type="text" name="user_name" id="user_name" placeholder="Owner" value="{{ ($photo->user->name) ?? old('user_name') }}" disabled="">
        </div>
    </div>
    <div class="field">
      <label for="owner">Created At</label>
        <div class="ui input">
            <input type="text" name="created_at" id="created_at" placeholder="Created At" value="{{ ($photo->created_at->toFormattedDateString() )  ?? old('created_at') }}" disabled="">
        </div>
    </div>
    @endif 
    
  
  <button class="ui fluid fluid primary submit button" type="submit" name="submit">
    @if(!empty($photo))
      Update
    @else
      Create
    @endif
    Photo
   </button> 
    </form>
</div>
</div>
@endsection

@section('post_scripts')
   @include('partials._filemanager_scripts_general')
@stop

