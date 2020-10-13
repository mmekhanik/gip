<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Album;
use Illuminate\Http\Request;

class PhotoController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
                  
        $user = auth()->user();
        $data['sorted_albums'] = Album::orderBy('name')->get();
        $data['album_id']=request('album_id');
        // $id=request('album_id');
          // $a=Photo::where('album_id',request('album_id'))->latest()->paginate(10);
        // // $a= Album::findOrFail(96)->get();
        $admin=$user->hasRole('superadministrator|administrator');
        if(request('album_id')){
            if($admin)
                $data["photos"] = Photo::where('album_id',request('album_id'))->latest()->paginate(10);
            else
                $data["photos"] = $user->photos()->where('album_id',request('album_id'))->latest()->paginate(10);
        }
        else{
            if($admin)
                $data["photos"] = Photo::latest()->paginate(10);
            else
                $data["photos"] = $user->photos()->latest()->paginate(10);
        }

        return view('backend.photo.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data["albums"] = Album::all();
        return view('backend.photo.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validation = $request->validate([
            'title' => 'required|string',
            'description' => 'string',
            'image' => 'image'
        ]);
        
        $subDir="/albums/".$request->album_id;
        $imgName = \photon_image_process($request,'image', $subDir);

        Photo::create([
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'description' => $request->description,
            'image' => $imgName,
            'user_id' => auth()->user()->id,
            'album_id' => $request->album_id
        ]);

        return redirect()->route('photo.index')->with('status','Album successfully created');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {

        $data["photo"] = $photo;
        return view('backend.photo.show',$data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        $data["albums"] = Album::all();
        $data["photo"] = $photo;
        return view('backend.photo.edit',$data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        $validation = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string'
        ]);
        
        $subDir="/albums/".$request->album_id;

        //dd($request->filled('image_url'));
        if($request->hasFile("image") || $request->filled('image_url')){
            $imgOldName = \photon_delete_image($photo->image,$subDir);
            $imgName = \photon_image_process($request,'image',$subDir);
            //dd($imgName);
            $photo->update([
                'title' => $request->title,
                'slug' => str_slug($request->title),
                'description' => $request->description,
                'image' => $imgName,
                'user_id' => auth()->user()->id,
                'album_id' => $request->album_id
            ]);
            //dd($imgName);
        }else{
            //dd($photo->album_id);
            // $album_id= (string)$photo->album_id;
            // dd($album_id);
            if( $request->album_id !== (string) $photo->album_id){
                //dd($request->album_id);
               \photon_move_image($photo->image, "/albums/".$photo->album_id, $subDir); 
            }
            //dd( (int) $photo->album_id);
            $photo->update([
                'title' => $request->title,
                'slug' => str_slug($request->title),
                'description' => $request->description,
                'user_id' => auth()->user()->id,
                'album_id' => $request->album_id
            ]);

        }
   

        session()->flash('type','success');
        session()->flash('message','Photo Successfully Updated');
        //return redirect()->back();
        $data["photo"] = $photo;
        return view('backend.photo.show',$data);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        //dd($photo->image);
        $subDir="/albums/".$photo->album_id;
        $imgName = \photon_delete_image($photo->image,$subDir);
        $photo->delete();
        return redirect()->route('photo.index')->with('status','Gallery successfully deleted');
    }
}
