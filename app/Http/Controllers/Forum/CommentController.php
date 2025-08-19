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

class CommentController extends Controller
{
 
    public function create($id,Request $request)
    { 
			$post = Post::find($id);
			$subject=$post->subject ;
	 
			if ($request->user()->cannot('comment', $subject)) {
				dd("not allowed");
			}
		  
	   return Inertia::render('forum/comment/create',[ 'post'=>$post ]); 
    }	
 
  
 
 
	public function store(Request $request)
    { 
			$data = $request->all(); 
					$request->validate([
						'body' => 'required', 
					]) ;
					
			$data['user_id']=auth()->id();
			 
			$getPost  = Post::find($data['post_id']);
			
			if($getPost->subject->comment_review==1){
				$data['status'] = 'under_review';
			}else{
				$data['status'] = 'accepted';
			}
			
			 $comment = Comment::create($data);
			 
		 
	   return to_route('post.view',["id"=>$data['post_id']]);
    }	
 
 
 
 
 	public function edit(Request $request,$id)
    { 
			$comment = Comment::find($id);
			
			 $post=$comment->post ;
			  
	   	   return Inertia::render('forum/comment/edit',[ 'comment'=>$comment ,  'post'=>$post ]); 
    }	
 
 
 
 	public function update(Request $request,$id)
    { 
	 
			$data	= $request->all();  
			$request->validate([ 
				  'body' => 'required', 
				]) ;
		 
	 $comment = Comment::find($id); 
	  $comment->update($data);
	 
		 if( $comment->post_id!=null){
	   return to_route('post.view',["id"=> $comment->post_id]);
		 }
	 
    }	
 
 
 	public function destory(Request $request,$id)
    { 
	  $comment = Comment::find($id); 
	  $comment->delete();
	  	   return to_route('post.view',["id"=> $comment->post_id]);
    }	
 
 
 
 
}
