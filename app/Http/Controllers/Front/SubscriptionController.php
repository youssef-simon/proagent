<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceImage;  
use App\Models\Subscription; 
use App\Models\SubscriptionProduct; 

class SubscriptionController extends Controller
{
	public function index(Request $request)
    { 
	
			   $subscriptions = SubscriptionProduct::all();
	 
	    return Inertia::render('front/subscription/index' ,['subscriptions'=>$subscriptions ]); 
    } 
	
    public function make_subscr(Request $request)
    {
		 	 $user = \Auth::guard('web')->user();
		 
		$getData = $request->all();
		// dd($getData);
		 $date = new \DateTime(); // Get today's date

		
	
		$subscr_id =  $request->get("id");
		
		$subscription = SubscriptionProduct::find($subscr_id);
		 
		 
		  //check of current rank if it bigger than new subsc make it else subscr to next else 
		 //
		 //
		$getCurrSubscr= $user->currentSubscription();
		$curRank =	$getCurrSubscr->subscription->rank;
		$newRank = $subscription->rank;
		if($newRank >$curRank){ 
				 $data['user_id']= $user->id; 
				 
				 $data['service_limit']= $subscription->service_limit;
				 $data['work_limit']= $subscription->work_limit;
				 $data['max_img']= $subscription->max_img; 
				 
				 $data['video_enabled']= $subscription->video_enabled;
				 $data['video_limit']= $subscription->video_limit;
				 $data['subscr_id']= $subscription->id;
				 
				 $data['from_date']= $date->format('Y-m-d');;
				 
				 $date->modify('+'.$subscription->period_month.' months'); // Add 6 months
		 
				 $data['to_date']= $date->format('Y-m-d');;
				 
				 
				 $data['is_paid']= 0;
			 
				 
				$getSubscr =  Subscription::create( $data);
		}
		
		$getCurrSubscr->next_subscr_id=$subscription->id;
		$getCurrSubscr->save();
    } 
}
