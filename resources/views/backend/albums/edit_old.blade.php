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

@if(!empty($album))
   
  <form action="{{ url('dashboard/albums/'.$album->id) }}" method="POST" enctype="multipart/form-data" class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-12">
      <div class="bg-white p-3"> 
        <h2>Update Album</h2>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
      <div class="form-group bg-white p-0">
        <input type="submit" value="Update" class="ui fluid fluid primary submit button">
      </div>
    </div>
    @method('PUT')
@else
  <form action="{{ url('dashboard/albums') }}" method="POST" enctype="multipart/form-data" class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-12">
      <div class="bg-white p-3"> 
        <h2>Create Album</h2>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
      <div class="form-group bg-white p-3">
          <input type="submit" value="Create" class="btn btn-primary btn-block">
      </div>
    </div>
@endif
    @csrf

    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="bg-white p-3">
        {{ photon_notification($errors)}}
          
        <div class="form-group">
          <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $album->name ?? old('name')}}">
        </div>
       
        <label for="name">Banner Source</label>
        <input type="text" class="form-control" name="banner_source" value="{{ $album->banner ?? old('banner_source') }}" disabled>
        
        <div class="form-group my-2 bg-white p-3">
          <label class="w-100">Banner</label>
          @if(!empty($album))
           <img src="{{ photon_thumbnail($album->banner, '/albums') }}" width="300" height="200">
          @endif
          <input type="file" name="banner" id="thumbnail">
          <label class="mt-3">Or Banner Url</label>
          <input type="url" class="form-control mt-2" name="banner_url"  id="thumbnail_url">
        </div>
      </div> <!-- class="bg-white p-3"  -->                  
    </div>  <!-- "col-lg-12 col-md-12 col-sm-12 col-12"  -->    
  </form>
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
                <a href="{{ route('photos.show',$photo->slug) }}"><img  src="{{ photon_thumbnail($photo->image, '/albums/'.$photo->album_id) }}" width="50" height="50"></a>
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
