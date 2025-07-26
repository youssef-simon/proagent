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
use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\Hash;


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
		 
		  $data['password'] = Hash::make($data['password']);

		 $user = User::create($data);
	
		 
		$slug = $data['first_name'].'_'.$data['last_name'].	$user->id;
		
		
	
		$user->slug= Str::slug($slug);
		$user->save();
		
		event(new Registered($user));


		return to_route('home.login', ["verf"=>1] );
		
	   
    }

	public function login(Request $request)
    {
		 
		   $data = $request->all();
		   $verf=0;
		   if(isset( $data['verf']) && $data['verf']==1){
			    $verf=1;
		   } else{
			     $verf=0;
		   }
		   
	   return Inertia::render('front/auth/login',[ 'verf'=> $verf ]);
    }

	
	
	
	
	public function login_check(Request $request)
{
    $validatedData = $request->validate([
        'email' => 'required|email',  // Added email validation
        'password' => 'required',
    ]);
    
    $credentials = $request->only(['email', 'password']);
    $remember = $request->get('remember', false);  // Default to false if not set
    
    // First attempt authentication
    if (!\Auth::guard('web')->attempt($credentials, $remember)) {
        return Inertia::render('front/auth/login', [
            'errorscode' => 'Wrong Username or Password'
        ]);
    }
    
    // If authentication succeeded, check email verification
    $user = User::where('email', $request->email)->first();
    
    if (!$user->email_verified_at) {
        // Log the user out since email isn't verified
        \Auth::guard('web')->logout();
        
        return Inertia::render('front/auth/login', [
            'errorscode' => 'Your email is not verified yet. Please check your email for verification instructions.'
        ]);
    }
    
    // Everything is good - redirect to dashboard
    return redirect('my_dashboard');
}

 
 
	
}
