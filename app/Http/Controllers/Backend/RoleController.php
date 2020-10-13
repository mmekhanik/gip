<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["roles"] = Role::all();
        return view("backend.roles.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data["permissions"] = Permission::all();
        return view("backend.roles.edit",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(),[
        'name' => 'required|string',
        'display_name' => 'required',
        'description' => 'required',
        ]);

        if($validator->fails()){
             return redirect()->back()->withErrors($validator);
          }
        
        $dataExist = Role::where('name',$request->name)->first();

        if($dataExist){

        Session::flash('type','danger');
        Session::flash('message','Role already exists');
        return redirect()->route('roles.create');
 
       }
        //dd($request);
        $role = Role::create([
          'name' => str_slug($request->name),
         'display_name' => $request->display_name,
        'description' => $request->description,
        ]);
        
        $role->attachPermissions($request->permissions);
     
        
        Session::flash('type','success');
        Session::flash('message','Role Successfully Created');
        
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        $data["role"] = $role;
        return view("backend.roles.show",$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $data["role"] = $role;
        $data["permissions"] = Permission::all();
        return view("backend.roles.edit",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd('update');
        $validation = $request->validate([
            'name' => 'required',
            'display_name' => 'required',
            'description' => 'required'
        ]);

        
    $role = Role::findOrFail($id);
    //dd($role);
    $role->update([
        'name' => str_slug($request->name),
        'display_name' => $request->display_name,
        'description' => $request->description,
    ]);

    $role->syncPermissions($request->permissions);
        
        session()->flash('type','success');
        session()->flash('message','Role Successfully Updated');
        return redirect()->route('roles.index');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        session()->flash('type','success');
        session()->flash('message','Role Deleted Successfully');
        return redirect()->route('roles.index');

    }

}
