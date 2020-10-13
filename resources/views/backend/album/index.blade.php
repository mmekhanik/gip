@extends('backend.layouts.app')


@section('content')

@breadcrumb()
    <li class="breadcrumb-item active">Albums</li>
@endbreadcrumb


<div class="bg-white p-0">
    <div class="row rounded overflow-hidden flex-md-row  position-relative">
        <div class="col-md-6 col d-flex flex-column position-static">
            <h3 class="mb-0">All Albums</h3>
        </div>
        <div class="col-md-6 col-auto d-flex flex-column">
            <div class="form-group  bg-white ">
                
                <select class="form-control" name="album_id" onchange="top.location.href = this.options[this.selectedIndex].value">
                   
                        <option selected>Select one</option>

                        @if (count($albums) > 0)

                            @foreach ($sorted_albums as $album)
                                {{ $data['album'] = $album }}
                                <option  value="{{ 

                                route('album.show', $data) }}">{{ $album->name }}</option>
                            @endforeach
                                
                        @endif
                </select>
            </div> 
        </div>
    </div> 

{{ photon_notification($errors)}}

@if (count($albums) > 0 )

    <table class="table table-bordered text-center mt-4">
        <tr>
            <th>Id</th>
            <th>Banner</th>
            <th>Name</th>
            <th>details</th>
        </tr>

            @foreach ($albums as $album)
            <tr>
                    <td>
                    {{ $album->id }}
                </td>
                <td>
                        <img src="{{ photon_thumbnail($album->banner, '/albums') }}" width="50" height="50">
                        </td>
        
                <td>
                        <a href="/gallery/{{ $album->slug }}" class="d-block text-guide guide-preview-title" target="_blank">{{ $album->name }}</a>
                </td>

                    <td>
                    <a href="{{ route('album.show',$album->slug) }}" class="btn btn-success">Details</a>
                    </td>
                </tr>
                        
            @endforeach
    </table>
        {{ $albums->links()}}
    @else
    
    <p class="bg-info">No album found yet</p>

    @endif
</div>

@endsection
