<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Message extends Model
{
    use HasFactory;
	
	
	 protected $casts = [
			'created_at' => 'datetime:Y-m-d H:m',
		];
		
		
	protected $fillable = [
        'sender_id',
        'thread_id',
        'receiver_id',
        'sender_type',
        'receiver_type',
        'message',
         
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
	
	
	
}