@extends('layouts.backend')

@section('title')
  @if(!empty($album))
    Album - {{$album->name}}
  @else
    Album - New
  @endif
@stop
@section('content')

<div class="ui segment large">
@if(!empty($albums))
  {!! Breadcrumbs::render('backend.albums.show',$album) !!}
@else
 {!! Breadcrumbs::render('backend.albums') !!}
@endif
</div><!--end of segment-->


<div class="bg-white p-3">

    <h3>Album Details</h3>

{{ photon_notification($errors) }}
    <table class="table table-bordered text-center mt-4">
        <tr>
            <th>Id</th>
            
            <td>
                    {{ $album->id }}
                </td>
    
        </tr>

    <tr>
            <th>Album Name</th>
            
            <td>
                    <a href="/gallery/{{ $album->slug }}" class="d-block text-guide guide-preview-title" target="_blank">{{ $album->name }}</a> 
                </td>
    
        </tr>
        <tr>
                <th>Banner Source</th>
                
                <td>
                        {{ $album->banner }}
                    </td>
        
            </tr>
    
        <tr>

        <tr>
                <th>Banner</th>
                
                <td>
                        <img src="{{ (isset($album) && $album->banner)? url(photo_thumbnail($album->banner,config('blogger.filemanager.upload_path'))): "" }}" width="100" height="100">
                    </td>
        
            </tr>
    
        <tr>
            
                <th>Actions</th>

        <td class="d-flex justify-content-center">

            @if(Auth::user()->hasRole('superadministrator|administrator'))
          <form class="form-inline form-delete-album" method="POST" action="/dashboard/albums/{{$album->id}}">
            {{csrf_field()}}
             <input name="_method" type="hidden" value="DELETE">
             <button class="ui mini button red" id="delete-album-{{$album->id}}" type="submit"><i class="icon remove album"></i> Delete</button>

          </form>
          @endif
              <a href="{{url('dashboard/albums/'.$album->id.'/edit')}}" id="edit-album-{{$album->id}}"  class="mini ui button positive"><i class="edit icon"></i> Edit</a>
        </td>
        </tr>
                        
    </table>

</div>
@endsection
