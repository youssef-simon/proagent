<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceImage; 

use App\Models\VerifyRequest; 

class VerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function verify_create()
    {
		  
		  
	   return Inertia::render('front/verification/create' );
    }


  
 

   /**
     * Display a listing of the resource.
     */
    public function verify_store(Request $request)
    {
		 $data = $request->all();  
		// dd( $data);
		 $user = \Auth::guard('web')->user(); 
		 $data['user_id']= $user->id;
		  
		  VerifyRequest::create( $data);
		   
	   return Inertia::render('front/service',[
			"services"=>$services ,
			"departments"=>$departments ,
	    ]);
    }
   
	
}
