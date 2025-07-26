<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectPermission    extends Model
{
       protected $fillable = ['subject_id', 'user_id', 'can_view', 'can_post' ,'can_comment'];
	   
	   
	   
	   
	
	public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

}
