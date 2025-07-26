<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\Post;
use App\Models\SubjectAdmin;

 use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    protected $fillable = [
        'title',
        'description',  	   
        'category_id',  	   
        'view_perm',  	   
        'post_perm',  	   
        'comment_perm',  	 
		
        'post_review',  	   
        'comment_review',  	   
    ];
	
	
	public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
	
	public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
	
	public function subjectadmins(): HasMany
    {
        return $this->hasMany(SubjectAdmin::class);
    }
		 
	public function latestApprovedPost()
	{
		return $this->hasOne(Post::class)
				 ///  ->where('status', 'approved')
				   ->latest(); // Orders by `created_at` DESC and takes the first one
	}


}
