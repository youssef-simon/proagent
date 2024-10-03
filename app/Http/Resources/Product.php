<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use App\Models\SizeProduct;


class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'slug',
        'description',
        'category_id',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

		
	public function sizes(){
		return $this->hasMany(SizeProduct::class, 'product_id');
	}

	
	
	public function images(){
		return $this->hasMany(ProductImage::class, 'product_id');
	}


	public function mainImage(){
		return $this->images()->where('main_image',1)->first();
	}
	
	
	
    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/products/'.$this->getKey());
    }
}
