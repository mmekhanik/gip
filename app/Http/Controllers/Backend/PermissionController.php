<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["permissions"] = Permission::all();
        return view("backend.permissions.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.permissions.edit");
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
        
        $dataExist = Permission::where('name',$request->name)->first();

        if($dataExist){

        Session::flash('type','danger');
        Session::flash('message','Permission already exists');
        return redirect()->route('permissions.create');
 
       }
        
        $permission = Permission::create([
            'name' => str_slug($request->name),
            'display_name' => $request->display_name,
            'description' => $request->description,
        ]);
        
        
        Session::flash('type','success');
        Session::flash('message','Ppermission Successfully Created');
        
        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);
        $data["permission"] = $permission;
        return view("backend.permissions.show",$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $data["permission"] = $permission;
        return view("backend.permissions.edit",$data);
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
        $validation = $request->validate([
            'name' => 'required',
            'display_name' => 'required',
            'description' => 'required'
        ]);

    $permission = Permission::findOrFail($id);   

    $permission->update([
        'name' => $request->name,
        'display_name' => str_slug($request->display_name),
        'description' => $request->description,
    ]);

        
        session()->flash('type','success');
        session()->flash('message','Permission Successfully Updated');
        return redirect()->route('permissions.index');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        session()->flash('type','success');
        session()->flash('message','Permission Deleted Successfully');
        return redirect()->route('permissions.index');

    }
}
