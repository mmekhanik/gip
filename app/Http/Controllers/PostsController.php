<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Tag;
use Carbon\Carbon;
use App\Repositories\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function __construct(){
    	$this->middleware('auth')->except(['index', 'show', 'blog']);
    }

    public function index(){

    	
    	return view('posts.index');

    }
    public function show(Posts $slug){
        $post=$slug;
       // dd($post->comments);
    	// $post=Posts::find($id);
        
    	return view('posts.show', compact('post'));
    	// return view('posts.show', ['post'=>$post]);

    }
    public function blog(Posts $posts){

    	//user scopefilter in Posts model
    	// $posts = Posts::latest()
    	// ->filter(request(['month', 'year']))
    	// ->get();

        $posts = Posts::latest()
        ->filter(request()
        ->only(["month", "year"]))
        ->paginate(10); 
        //simplePaginate
        //dd($posts);
    	$recentPost = Posts::recentPost();
        $top_post_width="6";
        if(count($recentPost)<2)
            $top_post_width="12";
       
    	return view('posts.blog', compact('posts', 'recentPost','top_post_width'));
    	//return view('posts.blog', compact('posts', 'archives'));
    	// return view('posts.blog', [
    	// 	'posts'=>$posts, 
    	// 	'archives'=>$archives
    	// ]);

    }
    public function create(){
    	
    	return view('posts.create');

    }
    public function store(Request $request){

    	//dd($request);
    	// $post=new Posts;
    	// $post->title=request('title');
    	// $post->body=request('body');
    	// // dd($post);
    	// $post->save();
    	$this->validate(request(),[
    			'title' => 'required',
    			'body' => 'required',
                'tags' => ''
    		]);

        $slug = Str::slug($request->title, '-');

    	// auth()->user()->publish(
    	// 	new Posts(request(['title', 'body']))
    	// 	);
    	$post = new Posts;
        $post->title = $request->input('title');
        $post->body =  htmlspecialchars($request->input('body'), ENT_QUOTES);
        $post->user_id = auth()->user()->id;
        $post->slug = $slug;
        $post->save();

        $input = $request->input("tags");
        //dd($input);

        if (DB::table('tags')->where('name', $input)->exists()){
            $tag = DB::table('tags')->where('name', $input)->value('id');
        }else{
        
            $Newtag = Tag::create([ 
                "name" => $input,
            ]);
            
            $tag = $Newtag->id;

        }
        // dd($tag);
        DB::table('posts_tag')->insert(
                ['posts_id' => $post->id, 
                'tag_id' => $tag]
            );
        // session()->flash('message', 'Your post has now been published');
        // session()->flash('message_important', true);

    	// return redirect('/post')->with([
     //            'message'=>'Your post has now been published',
     //            // 'message_important' => false
     //        ]);

        //flash()->overlay('Your post has now been published!', 'Published Successfully');
        flash()->success('Your post has now been published');

        return redirect('/post');

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
