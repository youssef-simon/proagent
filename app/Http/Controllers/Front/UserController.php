<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Service;
use App\Models\User;
use App\Models\ServiceCategory;
use App\Models\UserProject;
use App\Models\UserLink;
use App\Models\ServiceRequest;
use Illuminate\Support\Str;


use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
   
    public function index()
    {
		 $users = User::paginate(10); 
		  
	   return Inertia::render('front/users',[
			"users"=>$users , 
			]);
    }

 

     public function details($slug)
    {
		
		$user =	User::where('slug', $slug)->first();
		
		
		 
		 $user->tags =  $user->tags ; 
	 
		  $services = Service::where('user_id',$user->id)
		    ->where('status',Service::STATUS_ACCEPTED)
		  ->with('category')->with('category.department')
		  ->with('department') 
		 ->limit(24)
		 ->get();
		  
		  
		  $userprojects = UserProject::where('user_id',$user->id) 
		  ->where('status',UserProject::STATUS_ACCEPTED)
		->limit(24)		
		 ->get();
		  
		  
	   return Inertia::render('front/userdetails/user_view',[
				"user"=>$user ,  
				"services"=>$services ,  
				"userprojects"=>$userprojects ,  
			]);
    }
	
	
	 public function user_services($slug)
    {
			$user =	User::where('slug', $slug)->first();
		  	 $user->tags =  $user->tags ; 
		  
		  $services = Service::where('user_id',$user->id)
		  ->where('status',Service::STATUS_ACCEPTED)
		  ->with('category')->with('category.department')
		 
		  ->paginate(24);
		  
	   return Inertia::render('front/userdetails/user_services',[
			"user"=>$user ,  
			"services"=>$services ,  
			]);
    }
	
	
	 public function user_works($slug)
    {
		$user =	User::where('slug', $slug)->first();
		  	 $user->tags =  $user->tags ; 
		  $userprojects = UserProject::where('user_id',$user->id) 
		  ->where('status',UserProject::STATUS_ACCEPTED)
		  ->paginate(24);
		  
	   return Inertia::render('front/userdetails/user_projects',[
			"user"=>$user ,  
			"userprojects"=>$userprojects ,  
			]);
    }
	
	
	 public function work_view($id)
    {
		 
		 $userproject = UserProject::where('id',$id)->with('user')->with('projectImages')->first(); 
		  
		 
	   return Inertia::render('front/workView',[
		  
			"userproject"=>$userproject ,  
			]);
    }
	
	 public function user_links($slug)
    {
		
			 $user =	User::where('slug', $slug)->first();
			 
		   $userLinks = UserLink::where('user_id', $user->id) 
		//  ->where('status',UserLink::STATUS_ACCEPTED)
		  ->paginate(24);
		 
			return Inertia::render('front/userdetails/user_links',[
				"user"=>$user ,  
				"userLinks"=>$userLinks ,  
			]);
    }
	
	
	
	public function my_profile(Request $request)
    {
		  $user = \Auth::guard('web')->user();
		  
		  
		   return Inertia::render('front/user_profile',[
			"user"=>$user ,    
			]);
			 
    }

 
 	public function edit_profile(Request $request)
    {
		  $user = \Auth::guard('web')->user();
		  $user ->tags= $user->tags;
	   
	   $tagsInput =[];
	   foreach($user ->tags as $tagItm){
		$tagsInput []=['value'=> $tagItm->name,'label'=>  $tagItm->name];
	   }
	   
		   return Inertia::render('front/edit_profile',[
			"user"=>$user ,    
			"tagsInput"=>$tagsInput ,    
			]);
			 
    }
	
		public function update_profile (Request $request)
    {
		  $data	= $request->all();
		  
	   $user = \Auth::guard('web')->user();
 
 
 
 
 
 					
				 if(isset( $data['image_blob'])){
		/**************************************************/
			// Assuming $imageBlob contains your binary image data
			$imageBlob = $data['image_blob']; // Your BLOB data from database or request

			// Generate a unique filename
			$filename = 'public/media/' . uniqid() . '.jpeg'; // Adjust extension as needed
				$imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageBlob));
			// Save to disk (using default filesystem from config/filesystems.php)
			Storage::put($filename, $imageData);

			// If you need the full public URL (if using public disk)
			$url = Storage::url($filename);
 
			$data['imagpath']=	$filename;
 
		/**************************************************/ 
				 }
 
 
		$user->update($data);
		
		$slug = $data['first_name'].'_'.$data['last_name'].$user->id;
		 
		$user->slug= Str::slug($slug);
		$user->save();
		 
        if ($request->has('tags')) {
            $user->syncTags($request->tags);
        }
		return to_route('user.user_details',['id'=>$user->slug]);
    }
	
	
	
	
	
 
 
 
 
	public function my_dashboard(Request $request)  {
					$user = \Auth::guard('web')->user();
				
					$servicesCount = Service::where('user_id',$user->id)->count();
					
					$worksCount = UserProject::where('user_id',$user->id)->count();
					
					$myPurchases = ServiceRequest::where('user_req_id',$user->id)->count();
					
					$myRequested = ServiceRequest::where('user_make_id',$user->id)->count();
					
				//	$myRequested = Me::where('user_make_id',$user->id)->count();
					
					
					
					
					return Inertia::render('front/my_dashboard',[ 
					
					"user"=>$user,
					"servicesCount"=>$servicesCount,
					"worksCount"=>$worksCount,
					"myPurchases"=>$myPurchases,
					"myRequested"=>$myRequested,


					] );
	}
 
 
}
