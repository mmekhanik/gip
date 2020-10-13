@extends('layouts.backend')


@section('content')

<div class="ui segment large">
@if(!empty($permission))
  {!! Breadcrumbs::render('backend.permissions.edit',$permission) !!}
@else
  {!! Breadcrumbs::render('backend.permissions.create') !!}
@endif
</div><!--end of segment-->
<div class="bg-white p-3">
@if(!empty($permission))
    <h2>Update Permission</h2></div>
    <form action="{{ url('dashboard/permissions/'.$permission->id) }}" method="POST" enctype="multipart/form-data" class="row">
    @method('PUT')
@else
    <h2>Create Permission</h2></div>
    <form action="{{ url('dashboard/permissions') }}" method="POST" enctype="multipart/form-data" class="row">
@endif
@csrf  

    <div class="col-lg-8 col-md-8 col-sm-12 col-12">
        <div class="bg-white p-3">
                {{ photon_notification($errors)}}
            
            
            <div class="form-group">
                        <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ ($permission->name) ?? old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="display_name">Display Name</label>
                    <input type="text" class="form-control" name="display_name" value="{{ ($permission->display_name) ?? old('display_name') }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" value="{{ ($permission->description) ?? old('description') }}">
                    </div>
    
        </div>
            
    </div>    
    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
            @if(!empty($permission))
            
                <div class="form-group bg-white p-3">
                    <input type="submit" value="Update" class="ui fluid fluid primary submit button">
                </div>
            @else
                <div class="form-group bg-white p-3">
                    <input type="submit" value="Create" class="ui fluid fluid primary submit button">
                </div>
            @endif

            

                        
    </div>    

    

         
    </form>

@endsection
