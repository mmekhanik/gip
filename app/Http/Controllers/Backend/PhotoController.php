<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
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
           
        // dd($request);      
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

        return view('backend.photos.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($album_id=null)
    {   
        //dd($album_id);
        // $data["albums"] = Album::all();
        $data['sorted_albums'] = Album::orderBy('name')->get();
        $data['album_id'] = $album_id;
        return view('backend.photos.edit',$data);
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
            'description'=> 'required|string',
            'photo_image' => 'required|string'
        ]);
        
        $slug=$this->createSlug($request->title);

        $photo = Photo::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $request->photo_image,
            'user_id' => auth()->user()->id,
            'album_id' => $request->album_id
        ]);

        $user = auth()->user();
        $data['sorted_albums'] = Album::orderBy('name')->get();
        //dd($data['sorted_albums']);
        $data['album_id'] = $photo->album_id;
        $admin=$user->hasRole('superadministrator|administrator');
        if($photo->album_id){
            if($admin)
                $data["photos"] = Photo::where('album_id',$photo->album_id)->latest()->paginate(10);
            else
                $data["photos"] = $user->photos()->where('album_id',$photo->album_id)->latest()->paginate(10);
        }
        else{
            if($admin)
                $data["photos"] = Photo::latest()->paginate(10);
            else
                $data["photos"] = $user->photos()->latest()->paginate(10);
        }

        return redirect()->route('photos.index', $data)->with('status','Photo successfully created');


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
        return view('backend.photos.show',$data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = Photo::findOrFail($id);
        $data['sorted_albums'] = Album::orderBy('name')->get();
        $data["photo"] = $photo;
        return view('backend.photos.edit',$data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'title' => 'required|string',
            'description'=> 'required|string',
            'photo_image' => 'required|string'
        ]);
        $photo = Photo::findOrFail($id);
        $slug=$this->createSlug($request->title, $id);

        $photo->update([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $request->photo_image,
            'user_id' => auth()->user()->id,
            'album_id' => $request->album_id
        ]);

        session()->flash('type','success');
        session()->flash('message','Photo Successfully Updated');
        $user = auth()->user();
        $data['sorted_albums'] = Album::orderBy('name')->get();
        //dd($data['sorted_albums']);
        $data['album_id'] = $photo->album_id;
        $admin=$user->hasRole('superadministrator|administrator');
        if($photo->album_id){
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

        return view('backend.photos.index',$data);
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($photo->image);
        $photo = Photo::findOrFail($id);
        $data['album_id']=$photo->album_id;

        $photo->delete();

        return redirect()->route('photos.index',$data)->with('status','Photo successfully deleted');
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
        return Photo::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }
}
