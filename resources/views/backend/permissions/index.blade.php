@extends('layouts.backend')

@section('title', 'Permissions')

@section('content')

<div class="ui segment large">
  {!! Breadcrumbs::render('backend.permissions') !!}
</div><!--end of segment-->


<div class="bg-white p-3">
<h2>Permissions
    &nbsp;
    <a class="ui right floated tiny primary labeled icon button" href="{{url('dashboard/permissions/create')}}">
        <i class="user add icon"></i> Add New Permission
    </a>
</h2>


{{ photon_notification($errors)}}

@if (count($permissions) > 0 )

    <table class="table table-bordered text-center mt-4">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Description</th>
            <th>Update</th>
        </tr>

            @foreach ($permissions as $permission)
            <tr>
                    <td>
                    {{ $permission->id }}
                </td>

                <td>
                    {{ $permission->display_name }}
                </td>

                <td>
                    {{ $permission->description }}
                </td>

                <td>
                    <!-- <a href="{{ route('permission.show',$permission->name) }}" class="btn btn-success">Details</a> -->
                    <a href="{{url('dashboard/permissions/'.$permission->id.'/edit')}}" id="edit-permission-{{$permission->id}}"  class="mini ui button positive"><i class="edit icon"></i> Edit</a>
                   
                        <form class="form-inline form-delete-permission" method="POST" action="/dashboard/permissions/{{$permission->id}}">
                            {{csrf_field()}}
                             <input name="_method" type="hidden" value="DELETE">
                             <button class="ui mini button red" id="delete-permission-{{$permission->id}}" type="submit"><i class="icon remove permission"></i> Delete</button>

                        </form>
                </td>
                </tr>
                        
            @endforeach
    </table>
    @else
    
    <p class="bg-info">No permission found yet</p>

    @endif
</div>

@endsection
