<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Notifications\NewUserNotification;
use App\Notifications\VerifyMail;
use Illuminate\Support\Facades\Hash;
use App\Role;
use App\User;
use View;

class UserController extends Controller
{

    public function index()
    {
        $users = User::latest()->get();

        return View::make('backend.user.index', compact('users'));
    }

    public function show($id)
    {
        return redirect()->action('Backend\UserController@edit', $id);
    }

    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);

        $roles = Role::all();

        return View::make('backend.user.edit', compact('user', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();

        return View::make('backend.user.edit', compact('roles'));
    }

    public function store(UserCreateRequest $request)
    {
       $arr=$request->getValidRequest();
       if(empty($request->password)){
            $temp_password = str_random(7);
            $password = Hash::make($temp_password);
            $arr['password'] = $password;
        }
        $user = User::create($arr);

        //$user->resolveRole($request->role);
        $token = str_random(20);
        if(empty($request->password)){
            $user->email_verification_token=$token;
            $user->default_password=$temp_password;
            $user->save();
            $user->notify(new NewUserNotification($user,$temp_password));
        }else{
            $user->email_verification_token=$token;
            $user->save();
            $user->notify(new VerifyMail($user));
        }

        if(!empty($request->role)){
            $roles[]=$request->role;
            $user->syncRoles($roles);
        }

        return redirect('dashboard/users')->with('status', 'New user has been created');
    }

    public function update(UserUpdateRequest $request, $id)
    {

        $user = User::findOrFail($id);
        //$arr=$request->getValidRequest();
        //dd($arr);
        $user->fill($request->getValidRequest($id));
        //dd($user);
        $user->update();
        //dd($user);
        if(empty($request->role))
            $user->detachRoles($user->getRoles());
        else{
            $roles[]=$request->role;
            //dd($roles);
            //$user->resolveRole($request->role);
            $user->syncRoles($roles);
        }
        // dd($user->getRoles());
        return redirect()->to('dashboard/users/' . $id . "/edit")->with('status', 'User has been updated');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete($id);

        return redirect()->back()->with('status', 'User has been deleted');
    }
}
