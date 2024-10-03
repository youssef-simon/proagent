<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ProductAttribute;
use App\Models\AttributesValue;
use App\Models\Attribute;
use App\Models\ProductImage; 

class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $arr = parent::toArray($request);
   
   
       $img  =   $this->resource->mainImage()->first()->path; 
	   $img  =   str_replace("storage/","", $img );
	   $img  =   str_replace("media/","", $img );
	   $img  = url('cache/xlarge/' .$img);



   
   
	    $arr['img_path'] = $img;
   
   
   
   
   
			
			$locale=app()->getLocale();
			 
           $arr['name'] =  $this->resource->name;
           $arr['price'] = getPrice($this->resource->price);
		 
		   $arr['description'] = $this->resource->description;
           $arr['images'] = $this->images;
    
         
		  foreach($arr['images'] as $keyy=> $imgItm){
			  
				$img  =    $imgItm['image']['path'];
				
				   
			  $img  =   str_replace("storage/","", $img );
			  $img  =   str_replace("media/","", $img );
	  
				$img  = url('cache/xlarge/' .$img);
				$arr['images'][$keyy]['full_path']=$img;
				
		 }  
	
		     
          return $arr;
    }
}
