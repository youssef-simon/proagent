<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TaskStatus;
use App\Models\User;
 
class Task extends Model
{
    use HasFactory;
	
	public $timestamps = false;
	
	
		protected $fillable = [
        'name',  	 
        'description',  	
		'task_status_id', 
        'user_id' 	  	 
    ];
	
	
	public function employee(){
		 return $this->belongsTo(User::class, 'user_id');
	}
	
 
	public function taskStatus(){
		 return $this->belongsTo(TaskStatus::class, 'task_status_id');
	}
     
	
}
