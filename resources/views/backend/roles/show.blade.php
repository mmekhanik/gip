@extends('layouts.backend')

@section('title')
  @if(!empty($role))
    Role - {{$role->name}}
  @else
    Role - New
  @endif
@stop
@section('content')

<div class="ui segment large">
@if(!empty($role))
  {!! Breadcrumbs::render('backend.roles.show',$role) !!}
@else
 {!! Breadcrumbs::render('backend.roles') !!}
@endif
</div><!--end of segment-->


<div class="bg-white p-3">

    <h3>role Details</h3>

{{ photon_notification($errors) }}
    <table class="table table-bordered text-center mt-4">
        <tr>
            <th>Id</th>
            
            <td>
                    {{ $role->id }}
                </td>
    
        </tr>

    <tr>
            <th>Name</th>
            
            <td>
                    {{ $role->name }}
                </td>
    
        </tr>

        <tr>
            <th>Display Name</th>
            
            <td>
                    {{ $role->display_name }}
                </td>
    
        </tr>

        <tr>
                <th>Description</th>
                
                <td>
                    {{ $role->description}}
                </td>
        
            </tr>

            <tr>
                    <th>Permissions</th>
                    
                    <td>
                        
                        @if (count($role->permissions)>0)
                            @foreach($role->permissions as $permission)
                    <span>{{ $permission->display_name }}|</span>
                            @endforeach
                        @endif
                    </td>
            
                </tr>

                
        <tr>
            
                <th>Actions</th>

        <td class="d-flex justify-content-center">

        <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="Del">
        </form>
            <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-success ml-3">Edit</a>

        </td>


                    </tr>
                        
    </table>

</div>
@endsection
