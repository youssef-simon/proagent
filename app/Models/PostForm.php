<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostForm extends Model
{
    
	protected $casts = ['field_options'=>'array'];
	
	protected $fillable = [
        
        'subject_id',  	   
        'field_key',  	   
        'field_label',  	   
        'field_type',  	   
        'field_required',  	   
        'field_options',  	   
    ];
	
	
}
