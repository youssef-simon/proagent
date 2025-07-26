<?php

namespace App\Http\Controllers\Forum;


use App\Http\Controllers\Controller;
 
use App\Models\Post;
use App\Models\Comment;
use App\Models\Subject;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
 
    public function create($id,Request $request)
    { 
			$comment = Comment::find($id);
			
			$subject = $comment->post->subject;
			
			$post = $comment->post;
	 
	  	if ($request->user()->cannot('comment', $subject)) {
				dd("not allowed");
			}
		  
	   return Inertia::render('forum/reply/create',[ 
	   'post'=>$post,
	   'comment'=>$comment,

	   ]); 
    }	
 
  
 
 
	public function store(Request $request)
    { 
			$data = $request->all(); 
					$request->validate([
						'body' => 'required', 
					]) ;
			$data['user_id']=auth()->id();;
			 $comment = Comment::create($data);
			 
		 
	   return to_route('post.view',["id"=>$comment->comment->post->id]);
    }	
 
 
 
 
 
 
 
 
 
 
 
 
 
}
