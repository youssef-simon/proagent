<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class UserProject extends Model
{
    use HasFactory;
	
	
	
	 protected $fillable = [
        'title',
        'description', 
        'user_id', 
        'imagpath', 
    
    ];
	
	
		  protected $appends = ['image_path_show'];
		/**
     * Interact with the user's first name.
     */
    protected function getImagePathShowAttribute() 
    {						
		
		return Storage::url( $this->imagpath);
        
    }
}
