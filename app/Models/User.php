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
use App\Models\Subscription;
use App\Models\SubscriptionProduct;


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
    //    'tags',  	 
		
		
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
		if(!$this->imagpath){
		 return Storage::url("maleholder.png");
		}else{
			return Storage::url( $this->imagpath);
		}
     }
	
	 
	 
	 
	public function mainImage(){
		 return $this->belongsTo(MediaImage::class, 'main_image_id');
	}
      
	public function subscriptions()
	{
		return $this->hasMany(Subscription::class);
	}
		
		
	public function currentSubscription()
		{
			
			$subscriptionProduct =  SubscriptionProduct::where('is_free',1)->first();
			$getSubscr = $this->subscriptions()
				->where('cur_subscr', 1) // Adjust condition based on your schema
				->orderBy('created_at', 'desc') // In case of multiple active ones, get the latest
				->first();
				
				if($getSubscr==null){
					return $subscriptionProduct;
				 }else{
					 return $getSubscr;
				 }
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		  // Relationship to tags
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
    
    // Helper method to sync tags
    public function syncTags(array $tags)
    {
        $tagIds = collect($tags)->map(function ($tag) {
		 
            return Tag::firstOrCreate(['name' => strtolower(trim($tag['value']))])->id;
        });
        
        $this->tags()->sync($tagIds);
        
        return $this;
    }
    
    // Helper method to add a single tag
    public function addTag(string $tag)
    {
        $tagModel = Tag::firstOrCreate(['name' => strtolower(trim($tag))]);
        $this->tags()->attach($tagModel);
        
        return $this;
    }
}
