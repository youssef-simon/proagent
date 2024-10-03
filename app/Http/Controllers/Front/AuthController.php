<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Service;
use App\Models\User;
use App\Models\ServiceCategory;

class AuthController extends Controller
{
   
    public function register()
    {
		 
		  
	   return Inertia::render('front/auth/register' );
    }

	public function registerStore()
    {
		 
		  
	   return Inertia::render('front/auth/register' );
    }

	public function login()
    {
		 
		  
	   return Inertia::render('front/auth/login' );
    }

	public function login_check(Request $request)
    {
		
		 $data = $request->all(); 
		 
		 
		$validatedData = $request->validate([
			 'email' => 'required', 
			 'password' => 'required', 
		 
		 ]);
		 
		  
		  if (\Auth::guard('web')->attempt($request->only(['email','password']), $request->get('remember'))){
    
		return redirect('my_profile');
			} 
		
		   return back()->withInput($request->only('email', 'remember'));
	   return Inertia::render('front/auth/login' );
    }

 
 
	
}
