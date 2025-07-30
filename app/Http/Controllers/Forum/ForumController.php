<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
 
use App\Models\Category;
use App\Models\Post;
use App\Models\Subject;
use App\Models\Setting;
use App\Models\Comment;
use App\Models\PostForm;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

class ForumController extends Controller
{
 
    public function index()
    { 
		
		 $categories = Category::with(["subjects" => function($query) {
									$query->withCount('posts') 
									 ->with([
										   'latestApprovedPost.author' // Load only the latest approved post
									  ]);
								}])  
							 ->paginate(60);
								// dd($categories->get());
       return Inertia::render('front/sub_forum/forum/index',[ 'categories'=>$categories ]);
	    
    }
 
    public function index_posts($id,Request $request)
    {
		
		$dataArr =	$request->all();
	  
	  $pinnedPosts = Post::where('subject_id', $id)
	  ->with('author')
	  ->with('latestApprovedComment.user')
	  ->where("status","accepted")
	  ->where("pinned",1)
	  ->withCount('comments') ->get();  
	   
	  
	  $posts = Post::where('subject_id', $id)
	  ->with('author')
	   ->with('latestApprovedComment.user')
	  ->where("status","accepted")
	  ->withCount('comments');
			  
		 foreach($dataArr as $dKey => $dataItm){
			 if($dataItm!=''){
			  $posts=$posts->where('form_data->'.$dKey, $dataItm);
			 }
		 } 
			$posts =  $posts->orderBy('id','desc'); 
			$posts =  $posts->paginate(60); 
			
			$subject = Subject::find($id); 
			
		/* 	if ($request->user())	 {
				if ($request->user()->cannot('view', $subject)) {
					dd("not allowed");
				}
			} else {
				 if($subject->view_perm==1){
				 	dd("not allowed");
				}
			} */
			
		
		$postFormFields =	 PostForm::where("subject_id", $id)->get();
			  
			$postFormFieldArr=[]; 
			 foreach($postFormFields->toArray() as $arrKey=> $arrItm){
						$postFormFieldArr[ $arrItm['field_key']]=$arrItm['field_label'];
			 }
			  
			return Inertia::render('front/sub_forum/forum/post/index',[ 
					'id'=>$id,
					'posts'=>$posts
					,'pinnedPosts'=>$pinnedPosts
					,'subject'=>$subject
					,'postFormFields'=>$postFormFields
					,'dataArr'=>$dataArr
					,'postFormFieldArr'=>$postFormFieldArr
			]);
	 }
	
	public function view($id)
    { 
		$post = Post::where('id',$id)->with('images')->with('files')->with('author')->with('subject')->first(); 
		$comments = Comment::where('post_id',$id)->with("user")->with("replies.user")/* ->where('status','accepted') */->paginate(60);  
	 		 
			 	$postFormFields =	 PostForm::where("subject_id", $post->subject_id)->get();
			 
			 
			 	$postFormFieldArr=[]; 
			 foreach($postFormFields->toArray() as $arrKey=> $arrItm){
						$postFormFieldArr[ $arrItm['field_key']]=$arrItm['field_label'];
			 }
			 
			 
			 
	   return Inertia::render('front/sub_forum/forum/post/view',[ 
				'post'=>$post
			    ,'comments'=>$comments
				,'postFormFieldArr'=>$postFormFieldArr
	   ]); 
    }
 
}
