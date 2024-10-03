<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceRequest;
use App\Models\RequestMessage;


 

class MyPurchasesController extends Controller
{
	 
	
	 public function index(Request $request)
    {
		 $user = \Auth::guard('web')->user();
		 $serviceRequests = ServiceRequest::where('user_id', $user->id )->with('service')->paginate(10); 
		
		return Inertia::render('front/my_purchases/index',[
			"serviceRequests"=>$serviceRequests , 
			]);
    }
	 
     
}
