<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLink extends Model
{
		use HasFactory;
		
		const STATUS_PENDING=1;
		const STATUS_ACCEPTED=2;
		const STATUS_REFUSED=3;
	 
	
	
	    protected $fillable = [
        'title',
        'description',
        'link',
        'user_id', 
    ];
    
	
	
	
	
	
	
}
