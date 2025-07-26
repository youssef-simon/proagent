<?php

namespace App\Listeners;

use App\Events\CreateService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Notification; 

class NotifyCreateService
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
    public function handle(CreateService $event): void
    {
			$service = $event->service;
			 
			
		  $ndata['description']= "your service you create is under review";
		  $ndata['user_id']= 	$service->user_id;
	 
	 		Notification::create($ndata);
    }
}
