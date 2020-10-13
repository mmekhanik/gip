<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 
use App\Message;
use App\Models\Article;
use App\Service;
use Gipirion;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user=Auth::user();
        $following = Auth::user()->following->pluck('id');
        $messages = Message::whereIn('user_id', $following)->orwhere('user_id', Auth::user()->id)->get();
        // $messages = Auth::user()->messages;
        //$messages = DB::table('messages')->where('user_id',1)->get();
        //dd($user);
        return view('home', ['messages'=>$messages, 'user'=>$user]);

    }
    public function welcome()
    {
        $articles = Article::latest()->published()->paginate(3);
        //dd($articles);
        // $articles=null;
        $data['articles']=$articles;
        $data["ourservices"] = Service::latest()->published()->get();
        return view('welcome', $data);

    }
    public function dashboard()
    {
        return view('backend.index');
        
    }
}
