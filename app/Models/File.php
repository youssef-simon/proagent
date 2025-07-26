<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;

class File extends Model
{
 protected $fillable = ['path', 'original_name', 'mime_type'];


	 	protected $appends = ['file_show'];	

    public function fileable()
    {
        return $this->morphTo();
    }
	
	
	
	
	
		protected function getFileShowAttribute() 
    {						
		 return Storage::url( $this->path);
	}
	
	
	
	
	
	
	
}
