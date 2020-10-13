<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\ContactInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
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
        $data['infos'] = ContactInfo::orderBy('created_at','desc')->get();
        return view('backend.contacts.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.contacts.edit');
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
        'title' => 'required|string',
        'description' => 'string'
        ]);
          if($validator->fails()){
             return redirect()->back()->withErrors($validator);
          }

        
        $info = ContactInfo::create([
          'title' => $request->title,
         'slug' =>  $this->createSlug($request->title),
        'description' => $request->description
        ]);
        
        
        Session::flash('type','success');
        Session::flash('message','Info Successfully Created');
        
        $data['infos'] = ContactInfo::orderBy('created_at','desc')->get();
        return view('backend.contacts.index',$data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactInfo  $contactInfo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $info = ContactInfo::findOrFail($id);
        $data['info'] = $info;
        return view('backend.contacts.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactInfo  $contactInfo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = ContactInfo::findOrFail($id);
        $data["info"] = $info;
        return view('backend.contacts.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactInfo  $contactInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);
        $info = ContactInfo::findOrFail($id);

    $info->update([
        'title' => $request->title,
        'slug' =>  $this->createSlug($request->title, $id),
        'description' => $request->description,
    ]);

        
        session()->flash('type','success');
        session()->flash('message','Contact Info Successfully Updated');
        return redirect()->route('contacts.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactInfo  $contactInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ContactInfo::findOrFail($id)->delete($id);

        // return redirect()->back()->with('status', 'Contact has been deleted');
        session()->flash('type','success');
        session()->flash('message','Contact Successfully Deleted');
        return redirect()->route('contacts.index');
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
        return ContactInfo::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }
}
