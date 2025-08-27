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
			 
			   $ndata['description']=  "<a href='/service_view/".$service->id."'>$service->title</a> - ". __('app.your_service_you_put_is_under_review');
		
		   $ndata['user_id']= 	$service->user_id;
	// dd( $ndata);
	 		Notification::create($ndata);
    }
}
