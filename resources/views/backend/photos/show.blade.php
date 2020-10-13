@extends('layouts.backend')

@section('title')
  @if(!empty($photo))
    Photo - {{ $photo->title }}
  @else
    Photo - New
  @endif
@stop
@section('content')

<div class="ui segment large">
@if(!empty($photo))
  {!! Breadcrumbs::render('backend.photos.show',$photo) !!}
@else
 {!! Breadcrumbs::render('backend.photos') !!}
@endif
</div><!--end of segment-->


<div class="bg-white p-3">

    {{ photon_notification($errors) }}
    <h3>Photo Details</h3>
</div>
    <table class="table table-bordered text-center">
        <tr>
            <th>Id</th>
            
            <td>
                    {{ $photo->id }}
                </td>
    
        </tr>

    <tr>
            <th>Title</th>
            
            <td>
                    {{ $photo->title }}
                </td>
    
        </tr>
        <tr>
            <th>Album</th>
            <td>
                <a href="/gallery/{{ $photo->album->slug }}" class="d-block text-guide guide-preview-title" target="_blank">{{ $photo->album->name }}</a> 
                
            </td>
        </tr>
        <tr>
                <th>Image</th>
               
                <td>
                        <img src="{{ (!empty($photo->image))? url(photo_thumbnail($photo->image,config('blogger.filemanager.upload_path'))) : ""  }}" width="100" height="100">
                    </td>
        
            </tr>
    

            <tr>
                    <th>Description</th>
                    
                    <td>
                        {!! $photo->description !!}
                    </td>
            
                </tr>

                <tr>
                    <th>Owner</th>
                    
                    <td>
                        {{ $photo->user->name }}
                    </td>
            
                </tr>
                <tr>
                    <th>Created At</th>
                    
                    <td>
                        {{ $photo->created_at->toFormattedDateString() }}
                    </td>
            
                </tr>
                <tr>

            
                <th>Actions</th>

        <td class="d-flex justify-content-center">

        <form action="{{ route('photos.destroy',$photo->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="Del">
        </form>
            <a href="{{ route('photos.edit',$photo->id) }}" class="btn btn-success ml-3">Edit</a>

        </td>


                    </tr>
                        
    </table>

</div>
@endsection
