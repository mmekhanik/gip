@extends('layouts.backend')

@section('title', 'Photos')

@section('content')
<div class="ui segment large">
  {!! Breadcrumbs::render('backend.photos') !!}
</div><!--end of segment-->

<div class="ui segment teal padded">
@include('partials._success',['flashSuccess'=>'status'])
<h2>Photos
  &nbsp;

  <a class="ui right floated tiny primary labeled icon button" href="{{url('dashboard/photos/create/'.$album_id)}}">
      <i class="plus add icon"></i> Add New Photo
  </a>
</h2>

<div class="bg-white p-3">
    <div class="row rounded overflow-hidden flex-md-row  position-relative">
        <div class="col-md-6 col d-flex flex-column position-static">
            <h3 class="mb-0">All Photos</h3>
        </div>
        <div class="col-md-6 col-auto d-flex flex-column">
            <div class="form-group  bg-white ">
                
                <select class="form-control" name="album_id" onchange="top.location.href = this.options[this.selectedIndex].value">
                    <option value="{{ route('photos.index') }}" {{ (empty($album_id)) ? 'selected' : '' }}>Select All</option>
                        @if (count($sorted_albums) > 0)

                            @foreach ($sorted_albums as $album)
                                {{ $data['album'] = $album }}
                                <option  value="{{ 

                                route('photos.index', ['album_id'=>$album->id]) }}" {{ ($album_id==$album->id) ? ' selected' : '' }}>{{ $album->name }}</option>
                            @endforeach
                                
                        @endif
                </select>
            </div> 
        </div>
    </div> 

    {{ photon_notification($errors)}}
        
    @if (count($photos) > 0 )
    <table class="table table-bordered text-center mt-4">
        <tr>
            <th>Album</th>
            <th>Image</th>
            <th>Title</th>
            <th>Details</th>
        </tr>

            @foreach ($photos as $photo)
            <tr>
                    <td>
                <a href="/gallery/{{ $photo->album->slug }}" class="d-block text-guide guide-preview-title" target="_blank">{{ $photo->album->name }}</a> 
                
                </td>
                <td>
                    <a href="{{ route('photos.show',$photo->slug) }}"><img  src="{{ (!empty($photo->image))? url(photo_thumbnail($photo->image,config('blogger.filemanager.upload_path'))) : ""  }}" width="50" height="50"></a>
                </td>
        
                <td>
                    {{ $photo->title }}
                </td>

                <td>
                    <a href="{{url('dashboard/photos/'.$photo->id.'/edit')}}" id="edit-photo-{{$photo->id}}"  class="mini ui button positive"><i class="edit icon"></i> Edit</a>
                   
                        <form class="form-inline form-delete-photo" method="POST" action="/dashboard/photos/{{$photo->id}}">
                            {{csrf_field()}}
                             <input name="_method" type="hidden" value="DELETE">
                             <button class="ui mini button red" id="delete-photo-{{$photo->id}}" type="submit"><i class="icon remove photo"></i> Delete</button>

                        </form>
                      
                </td>
                </tr>
                        
            @endforeach
    </table>

    {{ $photos->appends(request()->input())->links()}}
    @else
    
    <p class="bg-info">No photo found yet</p>

    @endif
</div>
</div>
</div>
@endsection
