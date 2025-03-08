<?php

namespace App\Classes; 
use App\Models\Notification;



class CreateNotif 
{
	
 
    /**
     * @param  \Intervention\Image\Image  $image
     * @return \Intervention\Image\Image
     */
    public function __construct(ModelData $model)
    {
		if($model->type=="work"){
			$data['description']= "your achivment you put doesnt accepted";
			Notification::create($data);
		}
        
		if($model->type=="work"){
			
		}
		
    }
}