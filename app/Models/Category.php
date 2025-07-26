<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Subject;

class Category extends Model
{
 	protected $fillable = [
        'title',
        'description',  	   
    ];
	
	public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class, 'category_id');
    }
	
	
	
}
