<?php

namespace App\Http\Controllers;

use App\Team;
use App\Album;
use App\Photo;
use App\Service;
use App\ContactInfo;
use App\Models\User;
// use App\Mail\ContactForm;
use App\Notifications\ContactUsFormNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function home(){
        $data["albums"] = Album::orderBy('created_at','desc')->get();
        return view('frontend.index',$data);
    }

    public function albums(Request $request){
        $data['sorted_albums'] = Album::orderBy('name')->get();
        $data['album_id']=request('album_id');
        $data['photos'] = Photo::all()->groupBy('album_id');
        
        if(request('album_id')){
            $album = Album::where('id',request('album_id'))->get();
            $data["albums"] = $album;
            $data["name"]= ' - ' .$album[0]->name;
        }
        else{
            $data["albums"] = Album::orderBy('created_at','desc')->paginate(12); 
            $data["name"]=' - All';
        }
        return view('frontend.albums',$data);
    }

    // Gallery

    public function gallery($slug){
        $album = Album::where('slug',$slug)->first();
        $data["albums"] = Album::orderBy('created_at','desc')->get();
        $data["title"] = $album->name; 
        $data["photos"] = Photo::where("album_id",$album->id)->get(); 
        return view('frontend.gallery',$data);
    }

    // About

    public function about(){
        $data["albums"] = Album::orderBy('created_at','desc')->get();
        $data["teams"] = Team::orderBy('created_at','desc')->get();
        return view('frontend.about',$data);
    }

    // Contact

    public function contact(){
        $data["infos"] = ContactInfo::orderBy('created_at','desc')->get();
        return view('frontend.contact',$data);
    }

    public function contactForm(Request $request){
      
        $validator = Validator::make($request->all(),[
            'fname' => 'required',
            'lname' => 'required',
            'subject' => 'required',
            'email' => 'required|email',
            'message' => 'required|string',
            ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        //  dd( config('blogger.admin_email'));  
        $admin = User::where('email', config('blogger.admin_email'))->firstOrFail();
        //dd($admin);

        $admin->notify(new ContactUsFormNotification($request));
        
        // Mail::to('gipirioninfo@gmail.com')->send(new ContactForm($request->all()));
              
        session()->flash("type","success");
        session()->flash("message","Mail Send Successfully");
              
        return redirect()->route("contactacl");
    
    }

    // Service

    public function service(){
        $data["albums"] = Album::orderBy('created_at','desc')->get();
        $data["ourservices"] = Service::all();
        return view('frontend.service',$data);
    }

}
