<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

   // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


 

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }


	public function showAdminLoginForm()
    {
		      return Inertia::render('doctor/index',[ 'doctors'=>$doctors  ]);
        return view('auth.login', ['url' => route('admin.login-view'), 'title'=>'Admin']);
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (\Auth::guard('admin')->attempt($request->only(['email','password']), $request->get('remember'))){
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withInput($request->only('email', 'remember'));
    }
	
	
	
	
		
	 public function postEmpLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (\Auth::guard('web')->attempt($request->only(['email','password']), $request->get('remember'))){
			 
			 
            return redirect()->intended('/employee');
        }

        return back()->withInput($request->only('email', 'remember'));
    }
	
	 
	public function empLogin(Request $request)
    { 
			return Inertia::render('emp/login' );
    }
	
	
	
	
	
	 /**
     * Log out account user.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function logout()
    {
       

        \Auth::guard('web')->logout();
          
	   
  Session::flush();
        return redirect('/');
    }
	
	
	
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
