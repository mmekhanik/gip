@extends('backend.layouts.app')

@section('content')

@breadcrumb()
    <li class="breadcrumb-item active">Photo</li>
@endbreadcrumb


<div class="bg-white p-3">
     <div class="row rounded overflow-hidden flex-md-row  position-relative">
        <div class="col-md-6 col d-flex flex-column position-static">
            <h3 class="mb-0">All Photos</h3>
        </div>
        <div class="col-md-6 col-auto d-flex flex-column">
            <div class="form-group  bg-white ">
                
                <select class="form-control" name="album_id" onchange="top.location.href = this.options[this.selectedIndex].value">
                    <option value="{{ route('photo.index') }}" {{ (empty($album_id)) ? 'selected' : '' }}>Select All</option>
                        @if (count($sorted_albums) > 0)

                            @foreach ($sorted_albums as $album)
                                {{ $data['album'] = $album }}
                                <option  value="{{ 

                                route('photo.index', ['album_id'=>$album->id]) }}" {{ ($album_id==$album->id) ? 'selected' : '' }}>{{ $album->name }}</option>
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
                        <img src="{{ photon_thumbnail($photo->image, '/albums/'.$photo->album_id) }}" width="50" height="50">
                        </td>
        
                <td>
                    {{ $photo->title }}
                </td>

                    <td>
                    <a href="{{ route('photo.show',$photo->slug) }}" class="btn btn-success">Details</a>
                    </td>
                </tr>
                        
            @endforeach
    </table>

    {{ $photos->links()}}
    @else
    
    <p class="bg-info">No photo found yet</p>

    @endif

</div>
@endsection
