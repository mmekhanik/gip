<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\User;
//use Illuminate\Support\Facades\Hash;
//use App\Mail\WelcomeAgain;
use App\Http\Requests\RegistrationRequest;

class RegistrationController extends Controller
{
    public function create(){
    	
    	return view('registration.create');

    }

    public function store(RegistrationRequest $form){
    	
    	// $this->validate(request(),[
    	// 	'name' => ['required', 'string', 'max:255'],
     //        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
     //        'password' => ['required', 'string', 'min:8', 'confirmed'],
     //    ]);

        //create and save the user
        //$user = User::create(request(['name','email','password']));

        // $user = User::create([
        //     'name' => request('name'),
        //     'email' => request('email'),
        //     'password' => Hash::make(request('password')),
        // ]);
        // auth()->login($user);

        // \Mail::to($user)->send(new WelcomeAgain($user));
        $form->persist();

        session()->flash('message', 'Thanks for signing up');

        return redirect()->home();
    	//return view('sessions.create');

    }
}
