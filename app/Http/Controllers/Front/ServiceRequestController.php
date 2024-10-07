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

class ServiceRequestController extends Controller
{
	
	
	
	
	
	
	
	 public function index()
    {
		$user = \Auth::guard('web')->user();
		 $serviceRequests = ServiceRequest::where('user_make_id',$user->id)->with('service')->paginate(10); 
		  
	   return Inertia::render('front/requested_service/index',[
			"serviceRequests"=>$serviceRequests , 
			]);
    }
	
	
    /**
     * Display a listing of the resource.
     */
    public function makeRequest(Request $request)
    {
		 $getData=$request->all();
		  
		 
		 $serviceId = $request->get('service_id');
		$description = $request->get('description'); 
		
		$user = \Auth::guard('web')->user();
		   
		$getService = Service::find($serviceId);
		   
		$serviceRequest  = new ServiceRequest();
		$serviceRequest->service_id = $serviceId;
		$serviceRequest->user_make_id = $getService->user_id;
		$serviceRequest->user_req_id = $user->id;
		$serviceRequest->description = $description;
		$serviceRequest->save();
		 
		
		return to_route('request_view',["id"=>$serviceRequest->id]);
		
    }


	public function request_view($id){
		$serviceRequest = ServiceRequest::where('id',$id)->with("userMake")->with("userRequest")->first();
		 
		 
		  return Inertia::render('front/serviceRequest',[

	   "serviceRequest"=>$serviceRequest , 
	   
	   ]);
	}
	
	 
	
		
	 public function chatRoomMessages($id,Request $request)
    {
		   $chatRoomMessages =	RequestMessage::where('request_id',$id)->with('sender')->orderBy('id','desc')->paginate(10);
		  
		  return response()->json([
		      'data' =>$chatRoomMessages,  
		   ]); 
	}
	
	
	
		
	 public function sendRoomMsg(Request $request)
    {
		        $customer = auth('web')->user();
				$userId = $customer->id;
						 
				$data = $request->all();
				$data['sender_id'] = $userId;
				$data['sender_type'] = "App\Models\User";
			  
		        $messages = RequestMessage::create($data); 
		
		  return response()->json([
		      'data' =>$messages,  
		  ]); 
	}
	
 
     
	 	 public function changeToInProgress(Request $request)
    {
		$getReqId = $request->get('service_req_id');
		 
		 $serviceReq =	ServiceRequest::find($getReqId);
		 $serviceReq->status_id=2;
		 $serviceReq->save();
		
		 return to_route('request_view',["id"=>$getReqId ]);
	}
	
	
	
	 	 public function changeToDelivered(Request $request,$id)
    {
		
			$serviceReq =	ServiceRequest::find($id);
		 $serviceReq->status=3;
		 $serviceReq->save();
		
		  return response()->json([
		     'data' =>"done",   
		  ]); 
	}
	 
}
