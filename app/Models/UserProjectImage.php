<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class UserProjectImage extends Model
{
    use HasFactory;
	
		
	public $timestamps = false;
	
	protected $appends = ['image_path'];

	
	protected $fillable = [
         'path', 
        'project_id',
     ];
	 
	protected $table = 'user_project_images';
	 
	  /**
     * Interact with the user's first name.
     */
    protected function getImagePathAttribute() 
    {
		
		return  Storage::url( $this->path);
        
    }
	
	
}
