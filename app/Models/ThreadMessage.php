<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ThreadMessage extends Model
{
    use HasFactory;
	
	
	    protected $table = 'thread_messages';
		 
			
			protected $fillable = [
					'sec_user_id',
					'user_id', 
					'last_updated', 
					'last_sender_id', 
					'message', 
			 	];
	
	    /**
     * Get the parent imageable model (user or post).
     */
 /*    public function sender(): MorphTo
    {
        return $this->morphTo();
    } */
	
	
	    /**
     * Get the parent imageable model (user or post).
     */
   /*  public function reciver(): MorphTo
    {
        return $this->morphTo();
    } */
	
	public function sender(){
		 return $this->belongsTo(User::class, 'last_sender_id');
	}
}
