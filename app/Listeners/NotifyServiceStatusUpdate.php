<?php

namespace App\Listeners;

use App\Events\ServiceStatusUpdate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\Service;
use App\Models\Notification;

class NotifyServiceStatusUpdate
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ServiceStatusUpdate $event): void
    {
        $service = $event->service;
			 $status= $service->status;
			
		  $serviceLnkHref ="/service_view/".$service->id;
		 $serviceLnk='<a href="'. $serviceLnkHref.'">'.$service ->title.'</a>';
		 if($status==Service::STATUS_ACCEPTED){
		 $data['description']= $serviceLnk." - ".__('app.your_service_you_put_is_accepted');
		 
		 }
		  $reasonLnk ="/service_edit/".$service->id;
		 $reasonLnk='<a href="'. $reasonLnk.'">'.__('app.know_the_reason').'</a>';
		 
		if($status==Service::STATUS_REFUSED){
		 $data['description']= $serviceLnk." - ".__('app.your_service_you_put_is_refused').' '.$reasonLnk;
		 }
		 
		 if($status==Service::STATUS_PENDING){
		 $data['description']=  $serviceLnk." - ".__('app.your_service_you_put_is_under_review');
		 }
		
		 $data['user_id'] = $service->user_id;
		
		Notification::create($data);
	  
    }
}
