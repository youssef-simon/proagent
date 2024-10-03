<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ProductAttribute;
use App\Models\AttributesValue;
use App\Models\Attribute;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;

class PackProductListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
/*   print      public_path('upload') ;
  print'<br>';
  print      storage_path('app/public/media') ;
  
   die(); */
  
 /*      $img  =  $this->resource->mainImage()->first()->path;
	 $img  =   str_replace("media/","", $img );
	  $img  =   str_replace("public/","", $img );
$img  = url('cache/mediumcc/' .$img);
  */
 
      $arr['id'] = $this->resource->id;
          $arr['name'] = $this->resource->name;
      //   $arr['description'] = $this->resource->description; 
          $arr['code'] = $this->resource->code;
          $arr['price'] =  $this->resource->price;
          $arr['quantity'] =  $this->resource->quantity;
return $arr;
      
    }
}
