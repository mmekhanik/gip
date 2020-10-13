<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Album;
use Illuminate\Http\Request;


class AlbumController extends Controller
{

    public function __construct(){
        $this->middleware(['role:admin|superadministrator']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // $id=request('album_id');
        //  $a=Album::where('id',request('album_id'))->first();
        // // $a= Album::findOrFail(96)->get();
        // dd($a);
        // if(request('album_id'))
        //     $data["albums"] = Album::where('id',request('album_id'))->first();
        // else
            $data['sorted_albums'] = Album::orderBy('name')->get();
            $data["albums"] = Album::latest()->paginate(10);

        // dd($data["albums"]);
        return view('backend.album.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.album.create');
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
            'name' => 'required|string',
            'bannner' => 'image'
        ]);

        
        $imgName = \photon_image_process($request,"banner", "/albums");


        Album::create([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'banner' => $imgName
        ]);

        return redirect()->route('album.index')->with('status','Album successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        $data["album"] = $album;
        return view('backend.album.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {   
        $data["album"] = $album;
        return view('backend.album.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        $validation = $request->validate([
            'name' => 'required|string',
            'bannner' => 'image'
        ]);

        //dd($request->filled('banner_url'));

        if($request->banner || $request->filled('banner_url')){

            // $imgName = sprintf('%s%s.%s',str_random(10),
            // md5(time()),
            // $request->banner->extension());

            // $request->banner->storeAs('images',$imgName);
            $imgOldName = \photon_delete_image($album->banner, "/albums");
            $imgName = \photon_image_process($request,"banner", "/albums");
        }else{
            
            $imgName = $album->banner;
            
        }


        $album->update([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'banner' => $imgName
        ]);
        session()->flash('type','success');
        session()->flash('message','Album Successfully Updated');
        $data["album"] = $album;
        return view('backend.album.show',$data);
        // return redirect('/home/album')->with('status','Album updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $imgName = \photon_delete_image($album->banner, '/albums');
        $dirName =\photon_delete_dir('/albums/'.$album->id);
        $album->gallery()->delete();
        $album->delete();
        return redirect('/admin/album')->with('status','Album deleted successfully');
    }



    /**
     * Show frontend Album
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function catshow($slug)
    {

        $data['album'] = Album::where('slug',$slug)->first();
    
        return view('single',$data);
    }

    
}
