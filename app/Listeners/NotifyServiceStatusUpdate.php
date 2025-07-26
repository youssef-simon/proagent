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
		 $data['description']= "your service  $serviceLnk has been accepted check your service page"." <a href='/service_list'>services page</a>";
		 }
		 
		 
		if($status==Service::STATUS_REFUSED){
		 $data['description']= "your service  $serviceLnk you put doesnt accepted check your service page"." <a href='/service_list'>services page</a>";
		 }
		 
		 if($status==Service::STATUS_PENDING){
		 $data['description']= "your service  $serviceLnk is under Invertigating"." <a href='/service_list'>services page</a>";
		 }
		
		 $data['user_id'] = $service->user_id;
		
		Notification::create($data);
	  
    }
}
