<?php

namespace App\Http\Controllers\Forum;


use App\Http\Controllers\Controller;
 
use App\Models\Subject; 
use App\Models\Category; 
use App\Models\Post; 
use App\Models\Image; 
use App\Models\PostForm; 
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

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexCategory $request
     * @return array|Factory|View
     */
    public function index()
    {
			$posts = Post::paginate(60); 
       return Inertia::render('post/index',[ 'posts'=>$posts ]);
	    
    }
	
	
	  public function myPosts()
    {
			$user_id = auth()->user()->id;
			$posts = Post::where('user_id', $user_id )->paginate(60); 
       return Inertia::render('post/index',[ 'posts'=>$posts ]);
	    
    }
	
 
    public function create()
    {
		 $categories = Category::all();
         return Inertia::render('post/create',['categories'=>$categories]);
    }

    public function create_inside(Request $request,$id)
    {
		
		
		
		$subject = Subject::find($id); 
			 
		 if ($request->user()->cannot('create', $subject)) {
				dd("not allowed");
			}
	 
			
		$postFormFields =	 PostForm::where("subject_id", $id)->get();	 
	 
         return Inertia::render('front/sub_forum/post/create_inside',[ 
		 'id'=>$id
		 ,'postFormFields'=>$postFormFields
		 ]);
    }
     
	 public function store_inside(Request $request,$id)
    {
		 
        $data = $request->all(); 
		   
		$getSubject = Subject::find($id);
		  
        $data['subject_id']=$id;  
        $data['user_id']=$request->user()->id;  
	 
		if(	$getSubject ->post_review==1){
			 $data['status']='under_review'; 
		} else{
			 $data['status']='accepted'; 			
		}
	  
		$request->validate([
					  'title' => 'required', 
					  'description' => 'required', 
					]) ;
				 
        $post = Post::create($data);
  
  
		foreach($data['imgfields'] as $imgItm){
			if(isset($imgItm['path']) && $imgItm['path']!=null){
				 
				$post->images()->create($imgData);
			}
		}
		
		foreach($data['filefields'] as $fileItm){
					if(isset($fileItm['path']) && $fileItm['path']!=null){
			 
						  $post->files()->create($imgData);
					}
		}
	
		
        return to_route('post.index',['id'=>$post->subject_id]);
    }
	
	 
	 
	 
    public function store(Request $request)
    { 
        $data = $request->all(); 
		
			      $request->validate([
					  'title' => 'required', 
					  'description' => 'required', 
				]) ;
				
				 
		
		  $data['user_id']=$request->user()->id;  
        $post = Post::create($data);
  
  
		foreach($data['imgfields'] as $imgItm){
		 
			
			  $post->images()->create($imgItm);
		}
		
		foreach($data['filefields'] as $fileItm){
		 
			
			  $post->files()->create($fileItm);
		}
		
		
        return to_route('post.indexu');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Request $request,$id)
    {
		  $post = Post::where('id',$id)->with('images')->with('files')->first(); 
		  $categories = Category::all();
		  
		  if( $post ->user_id!=$request->user()->id){
			  print'not allowed';
			  die();
			  
		  }
		  
		  return Inertia::render('front/sub_forum/post/edit',[ 'post'=>$post,'categories'=>$categories  ]);
    }

  
    public function update(Request $request, $id)
    {
		$data	= $request->all(); 
		
			$request->validate([
				  'title' => 'required', 
				  'description' => 'required', 
				]) ;
		
		$post = Post::find($id); 
		$post->update($data);
		
		$post->images()->delete();
		
		
		
			foreach($data['imgfields'] as $imgItm){
					if(isset($imgItm['path']) && $imgItm['path']!=null){
						$post->images()->create($imgItm);
					}
			}
		$post->files()->delete();
		
		foreach($data['filefields'] as $fileItm){
			if(isset($fileItm['path']) && $fileItm['path']!=null){
			  $post->files()->create($fileItm);
			}
		}
		
		
		
		return to_route('post.index',['id'=>  $post->subject_id ]);
    }
 
    public function destroy($id)
    {
		 $post=Post::find($id);
		 $subject_id = $post->subject_id;
		
		  $post->delete();
			
		return to_route('post.index',['id'=> $subject_id]);
    }

   
}
