<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\ServiceImage;
use  App\Models\User;
use  App\Models\ServiceCategory;
use  App\Models\Department;

class Service extends Model
{
	
	
	const STATUS_PENDING=1;
	const STATUS_ACCEPTED=2;
	const STATUS_REFUSED=3;
 
	
	
	
    protected $fillable = [
        'title',
        'description',
        'price_from',
        'price_to',
        'email',
        'facebook',
        'telephone',
        'user_id',
        'imagpath',
        'category_id',
        'department_id',
        'status',
        'reason',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
	
	  protected $appends = ['image_path_show'];
	
	 
    protected function getImagePathShowAttribute() 
    {						
		 //return Storage::url( $this->imagpath);
		 
		 	if(!$this->imagpath){
		 return Storage::url("placeholder.png");
		}else{
			return Storage::url( $this->imagpath);
		}
	   
     }
	
	 
    public function serviceImages() 
    {
        return $this->hasMany(ServiceImage::class);
    }
    
    
	public function user(){
		 return $this->belongsTo(User::class, 'user_id');
	}
	 
	public function category(){
		 return $this->belongsTo(ServiceCategory::class, 'category_id');
	}
 
    public function department(){
		 return $this->belongsTo(Department::class, 'department_id');
	}
	
}
