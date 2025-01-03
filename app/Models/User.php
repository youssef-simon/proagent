<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
//use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;
use App\Models\Message;
use App\Models\MediaImage;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


	 
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'password',
	    'salary',  	 
        'department_id',  	 
        'imagpath',  	 
        'biograph',  	
		
        'work_title',  	 
        'small_bio',  	 
		
        'front_image_path',  	 
        'back_image_path',  	 
        'selffront_image_path',  	 
        'vertified',  	 
        'vertify_status',  	 
		
		
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
		'full_name',
		'image_path_show'
    ];
	
	
	
	 /**
     * Get the post's image.
     */
    public function messageSender(): MorphOne
    {
        return $this->morphOne(Message::class, 'sender');
    }
	
	
	 /**
     * Get the post's image.
     */
    public function messageReciver(): MorphOne
    {
        return $this->morphOne(Message::class, 'reciver');
    }
	
	
	protected  function fullName() : Attribute
	 {
	  return Attribute::make(
				
					get: fn (mixed $value, array $attributes) => $attributes['first_name'].' '.$attributes['last_name'],
			 );
	 }
	  
	 
	  protected function getImagePathShowAttribute() 
    {						
		 return Storage::url( $this->imagpath);
     }
	
	 
	 
	 
	public function mainImage(){
		 return $this->belongsTo(MediaImage::class, 'main_image_id');
	}
     
	
	
	
	
}
