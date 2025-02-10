<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class RequestMessage extends Model
{
    use HasFactory;
	 protected $casts = [
			'created_at' => 'datetime:Y-m-d H:m',
		];
		
	
			protected $fillable = [
					'request_id',
					'message', 
				 
				 
					
					'sender_id', 
					'sender_type',  
					
					
		'file_name',
		'file_path',
    ];
	
		
	    /**
     * Get the parent imageable model (user or post).
     */
    public function sender(): MorphTo
    {
        return $this->morphTo();
    }
	
	
	    /**
     * Get the parent imageable model (user or post).
     */
    public function reciver(): MorphTo
    {
        return $this->morphTo();
    }
	
	
	
	
	
	
	
	
	
	protected $appends = ['file_path_show'];
		 
    protected function getFilePathShowAttribute() 
    {						
		 return Storage::url( $this->file_path);
     }
	
	
}
