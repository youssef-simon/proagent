<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceImage; 

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
    public function verify_store()
    {
		 $services = Service::limit(10)->get();
		 $departments = Department::limit(10)->get();
		  
	   return Inertia::render('front/service',[
			"services"=>$services ,
			"departments"=>$departments ,
	    ]);
    }
   
	
}
