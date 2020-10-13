<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ProfileUpdateRequest;
use App\Http\Requests\Profile\CredentialUpdateRequest;
use App\Models\User;
use Auth;
use View;

class ProfileController extends Controller
{

   public function edit()
    {
        //dd('edit');
        $user = Auth::user();
        //dd($user);
        return View::make('backend.profile.edit', compact('user'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user_id = Auth::user()->id;

        $user = User::findOrFail($user_id);
        // dd($user);
        //dd($request->getValidRequest());
        $user->fill($request->getValidRequest($user_id));
        //dd($user);
        $user->update();
        //dd($user);
        return redirect()->back()->with('status', 'Profile has been updated');
    } 

    public function reset()
    {
        //dd('edit');
        $user = Auth::user();
        //dd($user);
        return View::make('backend.profile.reset', compact('user'));
    }

    public function passupdate(CredentialUpdateRequest $request)
    {
        $user_id = Auth::user()->id;

        $user = User::findOrFail($user_id);
         //dd($user);
        //dd($request->getValidRequest());
        $user->fill($request->getValidRequest());
        //dd($user);
        $user->update();
        //dd($user);
        return redirect()->back()->with('status', 'Your Credetials has been reset');
    }

}
