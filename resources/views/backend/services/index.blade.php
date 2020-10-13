@extends('layouts.backend')

@section('title', 'Services')

@section('content')

<div class="ui segment large">
  {!! Breadcrumbs::render('backend.services') !!}
</div><!--end of segment-->

<div class="bg-white p-3">
<h2>All Services
&nbsp;
  <a class="ui right floated tiny primary labeled icon button" href="{{url('dashboard/services/create')}}">
      <i class="plus add icon"></i> Add New Service
  </a>
</h2>
 
{{ photon_notification($errors) }}

    @if (count($ourservices) > 0 )
    <table class="table table-bordered text-center">
        <tr>
            <th>Id</th>
            <th>Image</th>
            <th>Title</th>
            <th>Level</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

            @foreach ($ourservices as $service)
            <tr>
                    <td>
                    {{ $service->id }}
                </td>
                <td>
                    <img src="{{ (!empty($service->thumbnail))? url(photo_thumbnail($service->thumbnail,config('blogger.filemanager.upload_path'))) : url('images/placeholder_640x480.png')}}" width="50" height="50">
                </td>
         
                <td>
                    {{ $service->title }}
                </td>
                 <td>
                    {{ $service->level }}
                </td>
                <td> 
                    @if($service->is_published && $service->published_at !== null &&  $service->published_at < Carbon\Carbon::now())
                   <span class="ui label green">Published</span>
                  @else
                    <span class="ui label grey">Draft</span>
                  @endif
                    </td>

                    <td>
                   <!--  <a href="{{ route('services.show',$service->slug) }}" class="btn btn-success">Details</a> -->
                    <a href="{{url('dashboard/services/'.$service->id.'/edit')}}" id="edit-service-{{$service->id}}"  class="mini ui button positive"><i class="edit icon"></i> Edit</a>
                   
                        <form class="form-inline form-delete-service" method="POST" action="/dashboard/services/{{$service->id}}">
                            {{csrf_field()}}
                             <input name="_method" type="hidden" value="DELETE">
                             <button class="ui mini button red" id="delete-service-{{$service->id}}" type="submit"><i class="icon remove service"></i> Delete</button>

                        </form>
                    </td>
                </tr>
                        
            @endforeach
    </table>
    @else
    
    <p class="bg-info">No service found yet</p>

    @endif

</div>
@endsection
