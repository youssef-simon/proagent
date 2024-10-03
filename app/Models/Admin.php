<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Message;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Admin   extends Authenticatable
{
    use HasFactory;
	
	 use HasRoles;
	 protected $appends = ['full_name'];

	protected $fillable = [
        'first_name',
        'last_name',
        'email', 
        'password', 	 
        'is_teacher', 	 
    ];
	
		  /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'first_name' => 'string', 
    ];
	 
	protected  function fullName() : Attribute
		{
				return Attribute::make(
				
					get: fn (mixed $value, array $attributes) => strtolower( $attributes['first_name'].' '.$attributes['last_name']),
				);
		}
	 
	 
}
