<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Posts;


class TagsController extends Controller
{
    public function index(Tag $tag){
    	//dd($tag->posts->all());
    	$posts=$tag->posts()->paginate(10);
    	$recentPost = Posts::recentPost();
    	$top_post_width="6";
        if(count($recentPost)<2)
            $top_post_width="12";
    	return view('posts.blog', compact('posts','recentPost', 'top_post_width'));

    }
}
