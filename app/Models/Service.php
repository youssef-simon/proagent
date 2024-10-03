<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\ServiceImage;
use  App\Models\User;

class Service extends Model
{
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
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
	
	  protected $appends = ['image_path_show'];
	
	 
    protected function getImagePathShowAttribute() 
    {						
		 return Storage::url( $this->imagpath);
     }
	
	 
    public function serviceImages() 
    {
        return $this->hasMany(ServiceImage::class);
    }
    
    
	public function user(){
		 return $this->belongsTo(User::class, 'user_id');
	}
   /*  public function user() 
    {
        return $this->hasMany(ServiceImage::class);
    } */
    
}
