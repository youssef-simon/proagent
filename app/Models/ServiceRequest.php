<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\User;


class ServiceRequest extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status_id',
        'service_id',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
     
	 
	public function service(){
		 return $this->belongsTo(Service::class, 'service_id');
	}
	
	public function userMake(){
		 return $this->belongsTo(User::class, 'user_make_id');
	}
	
	
	public function userRequest(){
		 return $this->belongsTo(User::class, 'user_req_id');
	}
	
}
