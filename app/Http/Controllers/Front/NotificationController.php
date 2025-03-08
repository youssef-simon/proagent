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
use App\Models\Notification; 

class NotificationController extends Controller
{
	public function index(Request $request)
    { 
	
	 $user = \Auth::guard('web')->user();
		 
	  $notifications = Notification::where('user_id',$user->id)->orderBy('id','desc')->paginate(20);
	 
	 Notification::where('user_id',$user->id)->update(['is_readed'=>1]);
	    return Inertia::render('front/notification/index' ,['notificationsdata'=>$notifications ]); 
    } 
	 
}
