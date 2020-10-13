@extends('layouts.backend')

@section('title', 'Contact Info')

@section('content')

<div class="ui segment large">
  {!! Breadcrumbs::render('backend.contacts') !!}
</div><!--end of segment-->

<div class="bg-white p-3">
    <h2>All Services
    &nbsp;
        <a class="ui right floated tiny primary labeled icon button" href="{{url('dashboard/contacts/create')}}">
      <i class="plus add icon"></i> Add New Contact
    </a>
    </h2>
        {{ photon_notification($errors)}}

    @if (count($infos) > 0 )
    <table class="table table-bordered text-center">
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>

            @foreach ($infos as $info)
            <tr>
                    <td>
                    {{ $info->id }}
                </td>
        
                <td>
                    {{ $info->title }}
                </td>

                <td>
                        {{ $info->description }}
                    </td>

                    <td>
                    <!-- <a href="{{ route('contactinfo.show',$info->slug) }}" class="btn btn-success">Details</a> -->
                    <a href="{{url('dashboard/contacts/'.$info->id.'/edit')}}" id="edit-contact-{{$info->id}}"  class="mini ui button positive"><i class="edit icon"></i> Edit</a>
                   
                        <form class="form-inline form-delete-contact" method="POST" action="/dashboard/contacts/{{$info->id}}">
                            {{csrf_field()}}
                             <input name="_method" type="hidden" value="DELETE">
                             <button class="ui mini button red" id="delete-contact-{{$info->id}}" type="submit"><i class="icon remove contact"></i> Delete</button>

                        </form>
                    </td>
                </tr>
                        
            @endforeach
    </table>
    @else
    
    <p class="bg-info">No album found yet</p>

    @endif

</div>
@endsection
