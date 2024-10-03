<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ProductAttribute;
use App\Models\AttributesValue;
use App\Models\Attribute;

class ProductListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {





       $img  =   $this->resource->mainImage()->first()->path; 
	   $img  =   str_replace("storage/","", $img );
	   $img  =   str_replace("media/","", $img );
	   $img  = url('cache/mediumcc/' .$img);


			$arr = parent::toArray($request);
         
			$locale=app()->getLocale();
          $arr['name'] = $this->resource->name;
          $arr['description'] = $this->resource->description;
           $arr['price'] = getPrice($this->resource->price);
		   
		   
		   if($this->resource->promo_price==0){
			   $arr['promo_price'] =0;
		   } else {
			$arr['promo_price'] = getPrice($this->resource->promo_price);
		   
		   }
		   
		   
           $arr['on_selection'] =  $this->resource->on_selection ;
		
		
           $arr['img_path'] = $img;
		   
		   
		   
		    
		   $sizePrices=[];
	
			$arr['prices'] = $sizePrices;
			
          return $arr;
    }
}
