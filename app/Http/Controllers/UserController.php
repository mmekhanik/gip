<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Notifications\NewUserNotification;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(){
        
        $this->middleware(['role:superadministrator'])->except(['profile','profile_update', 'password_update', 'passwordResetUpdate']);
    }

    // User Controller Settings

    public function profile(){
        return view('backend.user.profile');
    }

    public function profile_update(Request $request){

        if($request->password){
            $validator = Validator::make($request->all(),[
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|min:6|confirmed',
            ]);
        }else{
            $validator = Validator::make($request->all(),[
                'name' => 'required|string',
                'email' => 'required|email',
            ]);
        }
      
        if($validator->fails()){

            return redirect()->back()->withErrors($validator);
        }

        $user = User::where('email',auth()->user()->email)->first();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        if($request->password){
             $user->update([
               'password' => Hash::make($request->password),
            ]);
        }
        session()->flash('type','success');
        session()->flash('message','Your Profile Updated Successfully');
        return redirect()->route('user.profile');
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["users"] = User::latest()->paginate(10);
        return view("backend.users.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data["roles"] = Role::all();
        return view('backend.users.create',$data);
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
        'email' => 'required|email',
        'password' => 'min:6|confirmed',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
         
        $token = str_random(20);
        $temp_password = str_random(7);
        $password = Hash::make($temp_password);
        
        $user = User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => $password,
          'email_verification_token' => $token,
          'default_password' => $temp_password,
        ]);
          
        $user->email_verification_token=$token;
        $user->default_password=$temp_password;
        $user->save();
      
         // dd($user);
       
        $user->attachRoles($request->roles); // parameter can be a Role object, array, id or the role string name

        $user->notify(new NewUserNotification($user,$temp_password));
        
        Session::flash('type','success');
        Session::flash('message','User Successfully Created');
        
        return redirect()->route('user.index');
    }

    public function newUserPassSet($token,$id){

    }

        // Password Reset 

    public function password_update(){
         // dd(auth()->user());
        return view('frontend.auth.password-update');
    }


    // Password Reset Update 

    public function passwordResetUpdate(Request $request){

        $validator = Validator::make($request->all(),[
            'password' => 'required|min:6|confirmed',
        ]);

        if($validator->fails()){

            return redirect()->back()->withErrors($validator);
        }

        $user = User::where('email',auth()->user()->email)->first();
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        session()->flash('type','success');
        session()->flash('message','Password Successfully Updated');
        return redirect()->route('home');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $data["user"] = $user;
        return view("backend.users.show",$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data["user"] = $user;
        $data["roles"] = Role::all();
        return view("backend.users.edit",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // dd('update old');
        $validation = $request->validate([
            'email' => 'required|email',
        ]);

        
        $user->update([
            'email' => $request->email
        ]);
        // dd($request->roles);
        $user->syncRoles($request->roles);

        return redirect()->route('user.show',$user->id)->with('success','User updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('type','success');
        session()->flash('message','User deleted successfully');
        return redirect()->route('user.index');
    }


}
