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
use App\Models\VerifyRequest;


class VerifiedController extends Controller
{
 
 /*   public function index(Request $request)
    {
       $users = User:: where('id','!=',0);
		 
	   $vertify_status = $request->get('vertify_status');
	  if(isset($vertify_status)){
		     $users =    $users->where('vertify_status', $vertify_status);
	  }
	  $users ->paginate(20);
       return Inertia::render('verified_user/index',[ 'users'=>$users  ]);
    }*/ 
	
	
	
	
	
/* 	public function view(Request $request,$id)
    {
		
       $user = User:: find('id', $id);
		  
       return Inertia::render('verified_user/view',[ 'user'=>$user  ]);
    } 
	 */
	
	
	
	
	     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
		  $verifiedRequests = VerifyRequest:: where('id','!=',0);
		 
	   $vertify_status = $request->get('vertify_status');
	  if(isset($vertify_status)){
		     $verifiedRequests =    $verifiedRequests->where('vertify_status', $vertify_status);
	  }else{
		      $verifiedRequests =    $verifiedRequests->where('vertify_status', VerifyRequest::VERIFIED_UNDER);
	  }
	  $verifiedRequests=  $verifiedRequests ->paginate(20);
       return Inertia::render('verified_user/index',[ 'verifiedRequests'=>$verifiedRequests  ]);
    }


     
    public function view($id)
    {
		$verifiedRequest = VerifyRequest::find($id);

		return Inertia::render('verified_user/view' ,[ 'verifiedRequest'=>$verifiedRequest  ]);
    }

	
       
    public function update_status(Request $request)
    {
		 $getData = $request->all();
 
		  
		  $vertify_id = $request->get('id');
		  $vertify_status = $request->get('verify_status');
		 
			$verifiedRequest = VerifyRequest::find($vertify_id);
			$verifiedRequest->vertify_status=$vertify_status;
			$verifiedRequest->save();
		
		
		$getUser=User::find($verifiedRequest->user_id);
		$getUser->vertified=$vertify_status ;
		$getUser->save();
	dd($verifiedRequest);
		return Inertia::render('verified_user/view' ,[ 'verifiedRequest'=>$verifiedRequest  ]);
    }

	
	
}
