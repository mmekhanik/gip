<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function __construct(){
        $this->middleware(['role:administrator|superadministrator']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['ourservices'] = Service::orderBy('created_at','desc')->get();
        return view('backend.services.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.services.edit');
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
            'level' => 'required|numeric',
            'description'=>'required'
        ]);

        $arr=[
            'title' => $request->input('title'),
            'slug' => $this->createSlug($request->input('title')),
            'subtitle' => $request->input('subtitle'),
            'description' => $request->input('description'),
            'thumbnail' => $request->input('service_thumbnail'),
            'is_published' => $request->input('is_published') ?? false,
            'published_at' => $request->input('published_at'),
            'level' => $request->input('level'),
            'price'=>1
        ];
      
        $service = Service::create($arr);
 
          
        // $post = Service::create([
        //   'title' => $request->title,
        //  'slug' => str_slug($request->title),
        // 'description' => $request->description,
        // 'thumbnail' => $imgName,
        // 'price' => $request->price
        // ]);
        
        // Session::flash('type','success');
        // Session::flash('message','Service Successfully Created');
        
        return redirect('dashboard/services')->with('status', 'Service has been created');
        // return view('backend.services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $data['service'] = $service;
        return view('backend.services.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $data["service"] = $service;
        return view('backend.services.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
      
        $service = Service::findOrFail($id);
        $validation = $request->validate([
            'title' => 'required|string',
            'level' => 'required|numeric',
            'description'=>'required'
        ]);

        $arr=[
            'title' => $request->input('title'),
            'slug' => $this->createSlug($request->input('title'), $id),
            'subtitle' => $request->input('subtitle'),
            'description' => $request->input('description'),
            'thumbnail' => $request->input('service_thumbnail'),
            'is_published' => $request->input('is_published') ?? false,
            'published_at' => $request->input('published_at'),
            'level' => $request->input('level'),
        ];
        //dd($arr);

        $service->update($arr);

        session()->flash('type','success');
        session()->flash('message','Service Successfully Updated');
        return redirect()->route('services.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        session()->flash('type','success');
        session()->flash('message','Service Successfully Deleted');
        return redirect()->route('services.index');
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
        return Service::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }
}
