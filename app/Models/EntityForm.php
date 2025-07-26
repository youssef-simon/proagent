<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntityForm extends Model
{
    
	protected $casts = ['field_options'=>'array'];
	
	protected $fillable = [
        'entity_type',
        'field_key',  	   
        'field_label',  	   
        'field_type',  	   
        'field_required',  	   
        'field_options',  	   
		
        'only_admin',  	   
        'show_profile',  	   
        'show_label_profile',  	   
    ];
	
	
}
