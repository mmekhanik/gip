@extends('layouts.backend')

@section('title')
  @if(!empty($service))
    Service - {{$service->name}}
  @else
    Service - News
  @endif
@stop
 
@section('content')
<div class="ui segment large">
@if(!empty($service))
  {!! Breadcrumbs::render('backend.services.show',$service) !!}
@else
 {!! Breadcrumbs::render('backend.services') !!}
@endif
</div><!--end of segment-->

<div class="container">
<h2>Service Details</h2>

{{ photon_notification($errors) }}
    <table class="table table-bordered text-center">
        <tr>
            <th>Id</th>
            
            <td>
                    {{ $service->id }}
                </td>
    
        </tr>

    <tr>
            <th>Title</th>
            
            <td>
                    {{ $service->title }}
                </td>
    
        </tr>

        <tr>
                <th>Image</th>
                
                <td>
                        <img src="{{ (!empty($service->thumbnail))? url(photo_thumbnail($service->thumbnail,config('blogger.filemanager.upload_path'))) : url('images/placeholder_640x480.png') }}" width="100" height="100">
                    </td>
        
            </tr>
    

            <tr>
                    <th>Description</th>
                    
                    <td>
                        {!! $service->description !!}
                    </td>
            
                </tr>


                <tr>
            
                <th>Actions</th>

        <td class="d-flex justify-content-center">

        <form action="{{ route('services.destroy',$service->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="Del">
        </form>
            <a href="{{ route('services.edit',$service->id) }}" class="btn btn-success ml-3">Edit</a>

        </td>


                    </tr>
                        
    </table>

</div>
@endsection
