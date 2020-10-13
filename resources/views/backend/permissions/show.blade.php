@extends('layouts.backend')

@section('title')
  @if(!empty($permission))
    Permission - {{$permission->name}}
  @else
    Permission - New
  @endif
@stop
@section('content')

<div class="ui segment large">
@if(!empty($permission))
  {!! Breadcrumbs::render('backend.permissions.show',$permission) !!}
@else
 {!! Breadcrumbs::render('backend.permissions') !!}
@endif
</div><!--end of segment-->


<div class="bg-white p-3">

    <h3>permission Details</h3>

{{ photon_notification($errors) }}
    <table class="table table-bordered text-center mt-4">
        <tr>
            <th>Id</th>
            
            <td>
                    {{ $permission->id }}
                </td>
    
        </tr>

    <tr>
            <th>Name</th>
            
            <td>
                    {{ $permission->name }}
                </td>
    
        </tr>

        <tr>
            <th>Display Name</th>
            
            <td>
                    {{ $permission->display_name }}
                </td>
    
        </tr>

        <tr>
                <th>Description</th>
                
                <td>
                    {{ $permission->description}}
                </td>
        
            </tr>
    
        <tr>
            
                <th>Actions</th>

        <td class="d-flex justify-content-center">

        <form action="{{ route('permissions.destroy',$permission->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="Del">
        </form>
            <a href="{{ route('permissions.edit',$permission->id) }}" class="btn btn-success ml-3">Edit</a>

        </td>


                    </tr>
                        
    </table>

</div>
@endsection
