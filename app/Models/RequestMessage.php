<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestMessage extends Model
{
    use HasFactory;
	
	
			protected $fillable = [
					'request_id',
					'message', 
				 
				 
					
					'sender_id', 
					'sender_type', 
		
    ];
	
	
}
