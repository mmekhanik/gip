@extends('layouts.backend')

@section('content')

@if(!empty($info))
  {!! Breadcrumbs::render('backend.contacts.show',$info) !!}
@else
 {!! Breadcrumbs::render('backend.contacts') !!}
@endif

<div class="bg-white p-3">
<h3>Details Contact Info</h3>

{{ photon_notification($errors) }}

<table class="table table-bordered text-center">
        <tr>
            <th>Id</th>
            
            <td>
                    {{ $info->id }}
                </td>
    
        </tr>

    <tr>
            <th>Title</th>
            
            <td>
                    {{ $info->title }}
                </td>
    
        </tr>


            
            <tr>
                    <th>Description</th>
                    
                    <td>
                    <p>{{ $info->description }}</p>     
                    </td>
            
                </tr>
    
        <tr>
            
                <th>Actions</th>

        <td class="d-flex justify-content-center">

        <form action="{{ url('/dashboard/contacts/'.$info->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="Del">
        </form>
            <a href="{{url('dashboard/contacts/'.$info->id.'/edit')}}" id="edit-contact-{{$info->id}}" class="btn btn-success ml-3">Edit</a>

        </td>


                    </tr>
                        
    </table>

</div>
@endsection
