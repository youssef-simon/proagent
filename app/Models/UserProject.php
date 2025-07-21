<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\UserProjectImage;

class UserProject extends Model
{
    use HasFactory;
	
	  protected $appends = ['image_path_show','resize_image_path_show'];
	
	 protected $fillable = [
        'title',
        'description', 
        'user_id', 
        'imagpath', 
        'status', 
        'reason', 
    
    ];
	
	 
    protected function getImagePathShowAttribute() 
    {					
		if(!$this->imagpath){
		 return Storage::url("placeholder.png");
		}else{
			return Storage::url( $this->imagpath);
		}
	   
	}
	
	 	  /**
     * Interact with the user's first name.
     */
    protected function getResizeImagePathShowAttribute() 
    {
							
		if(!$this->imagpath){
		 return Storage::url("placeholder.png");
		}else{
			$originalPath =  Storage::url($this->imagpath);
					 
			$directory = dirname($originalPath); // 'public/media'
			$filename = basename($originalPath); // 'example.jpg' 
			$newFilename = 'resized_' . $filename; // 'resize_example.jpg'
			 
			$newPath = $directory . '/' . $newFilename; 


			return  $newPath;
		}
        
    }
	   
	public function user(){
		 return $this->belongsTo(User::class, 'user_id');
	}
	
	
	
	
	
	const STATUS_PENDING=1;
	const STATUS_ACCEPTED=2;
	const STATUS_REFUSED=3;
 
	
	
	
	 
    public function projectImages() 
    {
        return $this->hasMany(UserProjectImage::class,'project_id');
    }
    
	
	
	
	
}
