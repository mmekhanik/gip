<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Posts $slug){
        $post=$slug;
    	$this->validate(request(), ['body'=>'required|min:2']);
    	$post->addComment(request('body'));
    	// Comment::create([
    	// 	'body'=> request('body'),
    	// 	'posts_id'=>$post->id

    	// ]);
    	

    	return back();

    }
}
