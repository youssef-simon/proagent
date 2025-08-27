<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

 use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
	
	
	
	protected $casts = [
		'created_at' => 'datetime:Y-m-d H:i:s',
	 ];
 
	
  	protected $fillable = [ 
        'body',  	   
        'post_id',  	   
        'user_id',  	   
        'comment_id',  	   
        'status',  	   
    ];
	
	protected function casts(): array
	{
		return [
			'created_at' => 'datetime:Y-m-d H:m',
		];
	}
	
	public function user(){
		   return $this->belongsTo(User::class, 'user_id');
	}
	
		
	public function comment(){
		   return $this->belongsTo(Comment::class, 'comment_id');
	}
	
	 
	public function replies(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
	
	public function post(){
		   return $this->belongsTo(Post::class, 'post_id');
	}
	
	 
	
}
