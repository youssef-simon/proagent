<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Department;


class ServiceCategory extends Model
{
    protected $fillable = [
        'title',
        'desc',
        'parent',
        'department_id',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
     
	public function department(){
		 return $this->belongsTo(Department::class, 'department_id');
	}
	
}
