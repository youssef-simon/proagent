<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Post;
use App\Models\Comment;

use App\Models\Image;
use App\Models\File;
use App\Models\Subject;
use App\Models\User;

 use Illuminate\Database\Eloquent\Relations\HasMany;
 
 
 
class Post extends Model
{
	  protected $fillable = [
			'title',
			'description',  	   
			'subject_id',  	   
			'category_id',  	   
			'form_data',  	  
			'user_id',  
			'status',  
    ];
	
	
	protected $casts = [
	
	'form_data'=>'array',
	'created_at' => 'datetime:Y-m-d H:i:s',
	
	];
 
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
	
	
	  public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
	
	
	public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
	
	
	public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
	
	
		public function latestApprovedComment()
	{
		return $this->hasOne(Comment::class)
				 ///  ->where('status', 'approved')
				   ->latest(); // Orders by `created_at` DESC and takes the first one
	}
	
}
