@extends('layouts.backend')


@section('content')

<div class="ui segment large">
@if(!empty($role))
  {!! Breadcrumbs::render('backend.roles.edit',$role) !!}
@else
  {!! Breadcrumbs::render('backend.roles.create') !!}
@endif
</div><!--end of segment-->
<div class="bg-white p-3">
@if(!empty($role))
    <h2>Update Role</h2></div>
    <form action="{{ url('dashboard/roles/'.$role->id) }}" method="POST" enctype="multipart/form-data" class="row">
    @method('PUT')
@else
    <h2>Create Role</h2></div>
    <form action="{{ url('dashboard/roles') }}" method="POST" enctype="multipart/form-data" class="row">
@endif
    @csrf
    

    <div class="col-lg-8 col-md-8 col-sm-12 col-12">
        <div class="bg-white p-3">
                {{ photon_notification($errors)}}
            
            
            <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ ($role->name) ?? old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="display_name">Display Name</label>
                    <input type="text" class="form-control" name="display_name" value="{{ ($role->display_name) ?? old('display_name') }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" value="{{ ($role->description) ?? old('description') }}">
                    </div>
                    <div> <label for="permission">Permissions</label></div>
                     @if(!empty($role)) 
                    <div>
                      
                        @if (count($role->permissions)>0)
                            @foreach($role->permissions as $permission)
                    <span>{{ $permission->display_name }}|</span>
                            @endforeach
                        @endif
                    </div>
                    @endif
                    
                    <div class="form-group">
                        
                        <select name="permissions[]" class="form-control" multiple id="permission">

                            @if (count($permissions) > 0)
                                @foreach ($permissions as $permission)
                                    @if(!empty($role))
                                        <option value="{{ $permission->name }}" {{ in_array($permission['id'],$role->permissions->pluck('id')->toArray()) ? 'selected' : '' }} >
                                            {{ $permission->display_name }}
                                        </option>
                                    @else
                                          <option value="{{ $permission->id }}">{{ $permission->display_name }}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
    
        </div>
            
    </div>    
    <div class="col-lg-4 col-md-4 col-sm-12 col-12">

            
            <div class="form-group bg-white p-3">
                 @if(!empty($role))
                    <input type="submit" value="Update" class="ui fluid fluid primary submit button">
                @else
                    <input type="submit" value="Create" class="ui fluid fluid primary submit button">
                 @endif
            </div>

            

                        
    </div>    

    

         
    </form>

@endsection
