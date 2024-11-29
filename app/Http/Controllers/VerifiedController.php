<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Doctor;
use App\Models\Subject;
use App\Models\User;
use App\Models\Address;
use App\Models\Department;
use App\Models\ServiceCategory;
use App\Models\UserCategory;
use Illuminate\Validation\Rule; //import Rule class 
use Hash;



class VerifiedController extends Controller
{
 
    public function index(Request $request)
    {
       $users = User:: where('id','!=',0);
		 
	   $vertify_status = $request->get('vertify_status');
	  if(isset($vertify_status)){
		     $users =    $users->where('vertify_status', $vertify_status);
	  }
	  $users ->paginate(20);
       return Inertia::render('verified_user/index',[ 'users'=>$users  ]);
    } 
	
	
	
	
	
	public function view(Request $request,$id)
    {
		
       $user = User:: find('id', $id);
		  
       return Inertia::render('verified_user/view',[ 'user'=>$user  ]);
    } 
	
	
	
	
	
	
}
