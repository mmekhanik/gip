@extends('layouts.backend')

@section('title')
  @if(!empty($service))
    Service - Update
  @else
    Service - Create
  @endif
@stop

@section('content')

<div class="ui segment large">
@if(!empty($service))
  {!! Breadcrumbs::render('backend.services.edit',$service) !!}
@else
  {!! Breadcrumbs::render('backend.services.create') !!}
@endif
</div><!--end of segment-->

<div class="ui segment teal padded">

@if(!empty($service)) 
    <h2>Update Servce</h2>
    <form action="{{ url('dashboard/services/'.$service->id) }}" method="POST" class="ui form">
     @method('PUT')
@else
    <h2>Create Servce</h2>
    <form action="{{ url('dashboard/services') }}" method="POST" class="ui form">
@endif

   @csrf

  @include('partials._errors')
  @include('partials._success',['flashSuccess'=>'status'])

   <div class="field fluid {{ $errors->has('title') ? 'error' : '' }}">
    <label for="service-title">Title</label>
    <div class="ui input">
      <input type="text" name="title" id="service-title" placeholder="Title" value="{{  ($service->title) ?? old('title') }}" >
    </div>
  </div>

  <div class="field fluid {{ $errors->has('subtitle') ? 'error' : '' }}">
    <label for="service-subtitle">Subtitle</label>
    <div class="ui input">
      <input type="text" name="subtitle" id="service-subtitle" placeholder="Subtitle" value="{{  ($service->subtitle) ?? old('subtitle') }}" >
    </div>
  </div>
    <div class="field">
        <label for="service-image">Service Image</label>
        <div class="ui left action input">
            <button class="ui teal labeled icon button" id="service-pick-image">
                <i class="image icon"></i>
                Pick Image
            </button>
        <input type="text" name="service_thumbnail" id="service-image-path" value="{{($service->thumbnail) ?? old('service_thumbnail') }}" placeholder="relative image url"/>
        </div>

        <div class="ui segment left floated segment-margin">
            <div id="service-image-preview" class="ui medium bordered image">
                <img  src="{{ (isset($service) && $service->thumbnail)? url(photo_thumbnail($service->thumbnail,config('blogger.filemanager.upload_path'))): "" }}" height="5rem">
            </div>
        </div>
    </div>
    <div class="field {{ $errors->has('description') ? 'error' : '' }}">
        <label for="service-content">Description</label>
        <textarea id="service-content"  class="service-content" name="description">{{ ($service->description) ?? old('description') }}</textarea>
    </div>
    <div class="field">
        <label for="is_published">Is published</label>
         <div class="ui left floated compact segment segment-margin">
            <div class="ui fitted toggle checkbox">
                <input type="checkbox" name="is_published" value="1" {{ (isset($service) && $service->is_published === 1 || old('is_published')) ? 'checked' : '' }}>
            </div>
        </div>
    </div>
    <div class="field fluid {{ $errors->has('published_at') ? 'error' : '' }}">
    <label for="published_at">Published at</label>
    <div class="ui input">
      <input type="text" name="published_at" class="published-at" id="published_at" placeholder="YYYY-MM-DD H:i:s" value="{{ ($service->published_at) ?? old('published_at') }}" >
    </div>
  </div>
  <div class="field fluid {{ $errors->has('level') ? 'error' : '' }}">
    <label for="service-level">Level</label>
    <div class="ui input">
      <input type="text" name="level" id="service-level" placeholder="Level" value="{{  ($service->level) ?? old('level') }}" >
    </div>
  </div>
 <button class="ui fluid fluid primary submit button" type="submit" name="submit">
    @if(!empty($service))
      Update
    @else
      Create
    @endif
    Service
   </button> 
</form>
</div>
</div>
@endsection

@section('post_scripts')
   @include('partials._filemanager_scripts_general')
@stop
