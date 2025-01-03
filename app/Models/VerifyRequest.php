<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;

class VerifyRequest extends Model
{
		const VERIFIED_UNDER=1;
	const VERIFIED_APPROVED=2;
	const VERIFIED_REFUSED=3;
 
	
	   protected $fillable = [
        'front_image_path',
        'back_image_path',
        'selffront_image_path',
        'vertify_status',
		
        'user_id',
    
    ];
	
	
	
	
	
		  protected $appends = ['front_image_show','back_image_show','selffront_image_show'];
	
	  protected function getFrontImageShowAttribute() 
    {						
		 return Storage::url( $this->front_image_path);
     }
	 
		protected function getBackImageShowAttribute() 
    {						
		 return Storage::url( $this->back_image_path);
     }
	 
	 
	 
	 	protected function getSelffrontImageShowAttribute() 
    {						
		 return Storage::url( $this->selffront_image_path);
     }
	 
	 
	
    use HasFactory;
}
