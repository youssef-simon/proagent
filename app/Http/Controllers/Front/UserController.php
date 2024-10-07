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

class UserController extends Controller
{
   
    public function index()
    {
		 $users = User::paginate(10); 
		  
	   return Inertia::render('front/users',[
			"users"=>$users , 
			]);
    }

 

     public function details($id)
    {
		 $user = User::find($id); 
		  
		  $services = Service::where('user_id',$id)
		  ->with('category')->with('category.parentCategory')
		  ->get();
		  
	   return Inertia::render('front/userdetails/user_view',[
			"user"=>$user ,  
			"services"=>$services ,  
			]);
    }
	
	
	 public function user_services($id)
    {
		 $user = User::find($id); 
		  
		  $services = Service::where('user_id',$id)
		  ->with('category')->with('category.parentCategory')
		  ->paginate(24);
		  
	   return Inertia::render('front/userdetails/user_services',[
			"user"=>$user ,  
			"services"=>$services ,  
			]);
    }
	
	
	 public function user_works($id)
    {
		 $user = User::find($id); 
		  
		  $userprojects = UserProject::where('user_id',$id) 
		  ->paginate(24);
		  
	   return Inertia::render('front/userdetails/user_projects',[
			"user"=>$user ,  
			"userprojects"=>$userprojects ,  
			]);
    }
	
	
	 public function work_view($id)
    {
		 $user = User::find($id); 
		  
		  $userprojects = UserProject::where('user_id',$id) 
		  ->paginate(24);
		  
	   return Inertia::render('front/userdetails/user_projects',[
			"user"=>$user ,  
			"userprojects"=>$userprojects ,  
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
		  
		  
		   return Inertia::render('front/edit_profile',[
			"user"=>$user ,    
			]);
			 
    }
	
		public function update_profile (Request $request)
    {
		  $data	= $request->all();
		  /* $validatedData = $request->validate([
			'email' => 'required|email', // Example validation rules
		]); */
		
	  
	   $user = \Auth::guard('web')->user();
 
		$user->update($data);
		return to_route('home.user_details',['id'=>$user->id]);
    }
	
	
	
	
	
 
 
 
 
	public function my_dashboard(Request $request)  {
					$user = \Auth::guard('web')->user();
		
			
					return Inertia::render('front/my_dashboard',[
			"user"=>$user ,    
			] );
	}
 
 
}
