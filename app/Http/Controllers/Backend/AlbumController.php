<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
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
       $user = auth()->user();
       $admin=$user->hasRole('superadministrator|administrator|user');

        if($admin){
            $data['sorted_albums'] = Album::orderBy('name')->get();
            $data["albums"] = Album::latest()->get();
            $data['photos'] = Photo::all()->groupBy('album_id');
        }else{
            
            $data['sorted_albums'] = $user->albums()->orderBy('name')->get();
            $data["albums"] = $user->albums()->latest()->get();
            $data["photos"] = $user->photos()->where('album_id',$album->id)->latest()->get();
        }
        
        // $data['sorted_albums'] = Album::orderBy('name')->get();
        // $data["albums"] = Album::latest()->get();
        // $data['photos'] = Photo::all()->groupBy('album_id');

        // dd($data["albums"]);
        return view('backend.albums.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.albums.edit');
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
            'album_image' => 'required|string'
        ]);

        // dd ($this->createSlug($request->name));
        $album = Album::create([
            'name' => $request->name,
            'slug' => $this->createSlug($request->name),
            'banner' => $request->album_image,
            'user_id' => auth()->user()->id
        ]);
        $data["album"] = $album;
        // return redirect()->back()->with('status', 'Album has been created');
        return view('backend.albums.edit',$data)->with('status','Album successfully created');
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
        return view('backend.albums.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $album = Album::findOrFail($id);
        $data["album"] = $album;
        $user = auth()->user();
        $admin=$user->hasRole('superadministrator|administrator|user');

        if($id){
            if($admin)
                $data["photos"] = Photo::where('album_id',$album->id)->latest()->get();
            else
                $data["photos"] = $user->photos()->where('album_id',$album->id)->latest()->get();
        }
        
        // $data["photos"] = Photo::where("album_id",$album->id)->get(); 
        return view('backend.albums.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'name' => 'required|string',
            'album_image' => 'required|string'
        ]);
        $album = Album::findOrFail($id);
        // dd($album);

        if($album->name != $request->name)
            $slug=$this->createSlug($request->name, $id);
        else
            $slug=$album->slug;
        
        $album->update([
            'name' => $request->name,
            'slug' => $slug,
            'banner' => $request->album_image,
            'user_id' => auth()->user()->id
        ]);
        session()->flash('type','success');
        session()->flash('message','Album Successfully Updated');
        $data["album"] = $album;
        $user = auth()->user();
        $admin=$user->hasRole('superadministrator|administrator');

        if($id){
            if($admin)
                $data["photos"] = Photo::where('album_id',$album->id)->latest()->get();
            else
                $data["photos"] = $user->photos()->where('album_id',$album->id)->latest()->get();
        }
        // return view('backend.albums.edit',$data);
        return redirect()->back()->with('status', 'Album has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd('delete');
        $album = Album::findOrFail($id);
        $album->gallery()->delete();
        $album->delete();
        return redirect('/dashboard/albums')->with('status','Album deleted successfully');
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

    public function createSlug($title, $id = 0)
    {
        $slug = str_slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Album::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }

    
}
