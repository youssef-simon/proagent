<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; 


class SubjectAdmin extends Model
{
     protected $fillable = ['subject_id', 'user_id' ];
	 
	 	public function mod()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
