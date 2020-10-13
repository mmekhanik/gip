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
        <img  src="{{ (!empty($album->banner))? url(photo_thumbnail($album->banner,config('blogger.filemanager.upload_path'))) : ""}}" height="5rem">
      </div>
    </div>
    <div class="ui hidden divider"></div>
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
@if(!empty($album))
<div class="bg-white p-3">
  <h2>Photos
  &nbsp;
  <a class="ui right floated tiny primary labeled icon button" href="{{url('dashboard/photos/create/'.$album->id)}}">
      <i class="plus add icon"></i> Add New Photo
  </a>
  </h2>

  <div id="photo-table-list">
    <div class="ui left icon input table-list-search-input">
      <input type="text" class="search" placeholder="Search photos..." id="photo-list-search">
       <i class="file text outline icon"></i>
    </div>
    <div class="list-pagination top-list-pagination"></div>
    <table  class="ui celled table" cellspacing="0" width="100%">
      <thead>
        <tr class="text-center">
          <th class="sortable" data-sort="photo-table-image">Image <i class="sort icon"></i></th>
          <th class="sortable" data-sort="photo-table-title">Title <i class="sort icon"></i></th>
          <th class="sortable" data-sort="photo-table-album">album <i class="sort icon"></i></th>
          <th class="sortable" data-sort="photo-table-created-at">Created at <i class="sort icon"></i></th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="listable text-center">
        @if(isset($photos) && count($photos))
          @foreach($photos as $photo)
            <tr>
              <td class="photo-table-image">
                <a href="{{ route('photos.show',$photo->slug) }}"><img  src="{{ (!empty($photo->image))? url(photo_thumbnail($photo->image,config('blogger.filemanager.upload_path'))) : ""  }}" width="50" height="50"></a>
              </td>
              <td class="photo-table-title">{{str_limit($photo->title, $limit = 50, $end = '...')}}</td>
               <td class="photo-table-album"> <a href="/gallery/{{ $album->slug }}" class="d-block text-guide guide-preview-title" target="_blank">{{ str_limit($album->name, $limit = 50, $end = '...')  }}</a></td>
              <td class="photo-table-created-at">{{$photo->created_at->format('d M Y')}}</td>
              <td>
                <a href="{{url('dashboard/photos/'.$photo->id.'/edit')}}" id="edit-album-{{$album->id}}"  class="mini ui button positive"><i class="edit icon"></i> Edit</a>
                @if(Auth::user()->hasRole('superadministrator|administrator'))
                  <form class="form-inline form-delete-photo" method="POST" action="/dashboard/photos/{{$photo->id}}">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="ui mini button red" id="delete-photo-{{$photo->id}}" type="submit"><i class="icon remove photo"></i> Delete</button>
                  </form>
                @endif
              </td>
            </tr>

          @endforeach

        @endif
        <tr id="photo-table-no-results" style="display:none;">
          <td colspan="7">No results</td>
        </tr>
      </tbody>
    </table>
    <div class="list-pagination bottom-list-pagination">
      <div class="pagination-wrap flex">     
       <!--  <ul class="pagination"></ul> -->
          <ul class="pagination-layout pagination"></ul>     
      </div>
    </div>
  </div>
</div>

@endif
</div>
@endsection

@section('post_scripts')
   @include('partials._filemanager_scripts_general')
@stop
