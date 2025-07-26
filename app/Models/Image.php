<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
      protected $fillable = ['path', 'original_name', 'mime_type'];
		
	 	protected $appends = ['image_show'];	

	protected function getImageShowAttribute() 
    {						
		 return Storage::url( $this->path);
	}
	




    public function imageable()
    {
        return $this->morphTo();
    }
}
