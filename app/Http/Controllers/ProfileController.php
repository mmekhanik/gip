<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\User;
use App\Message;
use App\Notifications\NewFollower;

class ProfileController extends Controller
{
    public function index($user){
    	$user=User::findOrFail($user);
    	$messages=Message::where('user_id', $user->id)->get();
    	
    	return view('profile', [
    			'user'=>$user,
    			'messages'=>$messages
    		]);

    }

    public function followOrUnfollowUser(Request $request){
    	//dd($request);
    	if($request->follow){
    		//follow
    		$user=User::findOrFail($request->user);
    		Auth::user()->following()->attach($user->id);
    		$user->notify(new NewFollower(Auth::user()));
    	}else{
    		//unfollow
    		$user=User::findOrFail($request->user);
    		Auth::user()->following()->detach($user->id);
    	}

    	return redirect('/u/'.$user->id);
    	
    }
}
