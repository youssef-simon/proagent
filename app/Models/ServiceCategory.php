<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\ServiceCategory;


class ServiceCategory extends Model
{
    protected $fillable = [
        'title',
        'description',
        'parent_id',
        'department_id',
        'slug',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
     
	public function department(){
		 return $this->belongsTo(Department::class, 'department_id');
	}
	
	
	
	public function childCategories(){
		 return $this->hasMany(ServiceCategory::class, 'parent_id');
	}
	
	
	public function parentCategory(){
		 return $this->belongsTo(ServiceCategory::class, 'parent_id');
	}
	
}
