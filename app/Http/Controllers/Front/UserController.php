<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Service;
use App\Models\User;
use App\Models\ServiceCategory;

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
		  
		  $services = Service::where('user_id',$id)->get();
		  
	   return Inertia::render('front/user_view',[
			"user"=>$user ,  
			"services"=>$services ,  
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
