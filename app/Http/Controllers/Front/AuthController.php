<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Service;
use App\Models\User;
use App\Models\ServiceCategory;


 use Illuminate\Validation\Rule;   
 use Illuminate\Validation\Rules\Password;
 use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



class AuthController extends Controller
{
   
    public function register()
    {
		 
		  
	   return Inertia::render('front/auth/register' );
    }

	
	public function registerStore(Request $request)
    {
		 
		  $data	= $request->all();
		  
		  $validatedData = $request->validate([
		    'first_name' => 'required', 
		    'last_name' => 'required', 
		    'email' => 'required', 
		    'password' => ['required', 'confirmed', Password::min(8)],
	 
		]);
		
		  $validatedData = $request->validate([
		    
			'email' => Rule::unique('users')  
		]);
		 
		 	$user = User::create($data);
	
		 
		$slug = $data['first_name'].'_'.$data['last_name'].	$user->id;
		
	
		$user->slug= Str::slug($slug);
		$user->save();
		
		    Auth::login($user);

		return to_route('my_dashboard');
		
	   
    }

	public function login()
    {
		 
		  
	   return Inertia::render('front/auth/login' );
    }

	public function login_check(Request $request)
    {
		
		 $data = $request->all(); 
		 
		 $errorscode="";
		$validatedData = $request->validate([
			 'email' => 'required', 
			 'password' => 'required', 
		 
		 ]);
		 
		  
		  if (\Auth::guard('web')->attempt($request->only(['email','password']), $request->get('remember'))){
					return redirect('my_dashboard');
			} else{
					$errorscode="Wrong Username or Password";
			}
		
	  // return back()->withInput($request->only('errors', 'remember'));
	   return Inertia::render('front/auth/login' ,[ 'errorscode'=>$errorscode  ]);
    }

 
 
	
}
