<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
	
	
	 protected $fillable = [
        'service_limit', 
        'work_limit', 
        'max_img', 
        'video_enabled', 
        'video_limit', 
        'is_paid', 
        'user_id', 
        'subscr_id', 
        'from_date', 
        'to_date', 
    
    ];
}
