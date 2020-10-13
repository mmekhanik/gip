@extends('layouts.backend')

@section('title')
  @if(!empty($info))
    Contact - Update
  @else
    Contact - Create
  @endif
@stop

@section('content')

<div class="ui segment large">
@if(!empty($info))
  {!! Breadcrumbs::render('backend.contacts.edit',$info) !!}
@else
  {!! Breadcrumbs::render('backend.contacts.create') !!}
@endif
</div><!--end of segment-->

<div class="ui segment teal padded">
    @if(!empty($info)) 
        <h2>Update Contact</h2>
        <form action="{{ url('dashboard/contacts/'.$info->id) }}" method="POST" class="ui form">
     @method('PUT')
    @else
     <h2>Create Contact</h2>
        <form action="{{ url('dashboard/contacts') }}" method="POST" class="ui form">
    @endif

   @csrf

  @include('partials._errors')
  @include('partials._success',['flashSuccess'=>'status'])

  {{ photon_notification($errors)}}
    
    <div class="field fluid {{ $errors->has('title') ? 'error' : '' }}">
        <label for="service-title">Title</label>
        <div class="ui input">
          <input type="text" name="title" id="service-title" placeholder="Title" value="{{  ($info->title) ?? old('info') }}" >
        </div>
    </div>
    <div class="field {{ $errors->has('description') ? 'error' : '' }}">
        <label for="service-content">Description</label>
        <textarea id="service-content"  class="service-content" name="description">{{ ($info->description) ?? old('description') }}</textarea>
    </div>

     <button class="ui fluid fluid primary submit button" type="submit" name="submit">
    @if(!empty($info))
      Update
    @else
      Create
    @endif
    Contact
    </button>      
    </form>
</div>
</div>


@endsection
