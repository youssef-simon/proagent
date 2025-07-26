<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
	
	protected $fillable = ['name', 'type'];
    
    // Relationship to any taggable model
    public function users()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }
    
    // Add more relationships for other taggable models as needed
}
