<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;


class ServiceImage extends Model
{
    use HasFactory;
	
	    protected $appends = ['image_path','resize_image_path'];
 

	
	protected $fillable = [
         'path', 
        'service_id',
     ];
	 
	 
	 
	  /**
     * Interact with the user's first name.
     */
    protected function getImagePathAttribute() 
    {
		
		return  Storage::url( $this->path);
        
    }
	
	  /**
     * Interact with the user's first name.
     */
    protected function getResizeImagePathAttribute() 
    {
		
			$originalPath =  Storage::url($this->path);
					 
			$directory = dirname($originalPath); // 'public/media'
			$filename = basename($originalPath); // 'example.jpg' 
			$newFilename = 'resized_' . $filename; // 'resize_example.jpg'
			 
			$newPath = $directory . '/' . $newFilename; 


			return  $newPath;
        
    }
}
