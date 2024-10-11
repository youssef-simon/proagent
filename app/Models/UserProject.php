<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\UserProjectImage;

class UserProject extends Model
{
    use HasFactory;
	
	  protected $appends = ['image_path_show'];
	
	 protected $fillable = [
        'title',
        'description', 
        'user_id', 
        'imagpath', 
    
    ];
	
	 
    protected function getImagePathShowAttribute() 
    {						
		 return Storage::url( $this->imagpath);
	}
	
	 
	   
	public function user(){
		 return $this->belongsTo(User::class, 'user_id');
	}
	
	
	
	
	
	
	
	
	 
    public function projectImages() 
    {
        return $this->hasMany(UserProjectImage::class,'project_id');
    }
    
	
	
	
	
}
