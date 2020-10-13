@extends('layouts.backend')

@section('title', 'Albums')


@section('content')
<div class="ui segment large">
  {!! Breadcrumbs::render('backend.albums') !!}
</div><!--end of segment-->
<div class="ui segment teal padded">
  @include('partials._success',['flashSuccess'=>'status'])
  <h2>Albums
    &nbsp;
    <a class="ui right floated tiny primary labeled icon button" href="{{url('dashboard/albums/create')}}">
        <i class="plus add icon"></i> Add New Album
    </a>
  </h2>

  <div id="album-table-list">
    <div class="ui left icon input table-list-search-input">
      <input type="text" class="search" placeholder="Search albums..." id="album-list-search">
       <i class="file text outline icon"></i>
    </div>
    <div class="list-pagination top-list-pagination"></div>
      <table  class="ui celled table" cellspacing="0" width="100%">
        <thead>
              <tr class="text-center">
                  <th class="sortable" data-sort="album-table-id"> Id <i class="sort icon"></i></th>
                  <th class="sortable" data-sort="album-table-banner">Banner <i class="sort icon"></i></th>
                  <th class="sortable" data-sort="album-table-title">Title <i class="sort icon"></i></th>
                   <th class="sortable" data-sort="album-table-photo-count"># of Photos <i class="sort icon"></i></th>
                  <th class="sortable" data-sort="album-table-created-at">Created at <i class="sort icon"></i></th>
                  <th>Actions</th>
              </tr>
          </thead>
          <tbody class="listable text-center">
          @if(isset($albums) && count($albums))
            @foreach($albums as $album)
              <tr>
                <td class="album-table-id">{{$album->id}}</td>
                <td class="album-table-banner"><img src="{{(!empty($album->banner))? url(photo_thumbnail($album->banner,config('blogger.filemanager.upload_path'))) : ""  }}" width="50" height="50"></td>
                 <td class="album-table-title"> <a href="/gallery/{{ $album->slug }}" class="d-block text-guide guide-preview-title" target="_blank">{{ str_limit($album->name, $limit = 50, $end = '...')  }}</a></td>
                 <td class="album-table-photo-count">@if(!empty($photos[$album->id]))
                        {{ $photos[$album->id]->count() }}
                      @else
                        0
                      @endif </td>
                <td class="album-table-created-at">{{$album->created_at->format('d M Y')}}</td>
                <td>
                  <a href="{{url('dashboard/albums/'.$album->id.'/edit')}}" id="edit-album-{{$album->id}}"  class="mini ui button positive"><i class="edit icon"></i> Edit</a>
                  @if(Auth::user()->hasRole('superadministrator|administrator'))
                  <form class="form-inline form-delete-album" method="POST" action="/dashboard/albums/{{$album->id}}">
                    {{csrf_field()}}
                     <input name="_method" type="hidden" value="DELETE">
                     <button class="ui mini button red" id="delete-album-{{$album->id}}" type="submit"><i class="icon remove album"></i> Delete</button>

                  </form>
                  @endif
                </td>
              </tr>

            @endforeach

        @endif
              <tr id="album-table-no-results" style="display:none;"><td colspan="7">No results</td></tr>
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
</div>
@endsection
