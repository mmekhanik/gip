@extends('layouts.backend')

@section('title', 'Roles')

@section('content')

<div class="ui segment large">
  {!! Breadcrumbs::render('backend.roles') !!}
</div><!--end of segment-->


<div class="bg-white p-3">

{{ photon_notification($errors)}}
<h2>Roles
    &nbsp;
    <a class="ui right floated tiny primary labeled icon button" href="{{url('dashboard/roles/create')}}">
        <i class="user add icon"></i> Add New Role
    </a>
</h2>

@if (count($roles) > 0 )

    <table class="table table-bordered text-center mt-4">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Description</th>
            <th>Update</th>
        </tr>

            @foreach ($roles as $role)
            <tr>
                    <td>
                    {{ $role->id }}
                </td>

                <td>
                    {{ $role->display_name }}
                </td>

                <td>
                    {{ $role->description }}
                </td>

                <td>
                   <!--  <a href="{{ route('roles.show',$role->name) }}" class="btn btn-success">Details</a> -->
                    <a href="{{url('dashboard/roles/'.$role->id.'/edit')}}" id="edit-role-{{$role->id}}"  class="mini ui button positive"><i class="edit icon"></i> Edit</a>
                   
                        <form class="form-inline form-delete-role" method="POST" action="/dashboard/roles/{{$role->id}}">
                            {{csrf_field()}}
                             <input name="_method" type="hidden" value="DELETE">
                             <button class="ui mini button red" id="delete-role-{{$role->id}}" type="submit"><i class="icon remove role"></i> Delete</button>

                        </form>
                      
                    </td>
                </tr>
                        
            @endforeach
    </table>
    @else
    
    <p class="bg-info">No role found yet</p>

    @endif
</div>

@endsection
