<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ProductAttribute;
use App\Models\AttributesValue;
use App\Models\Attribute;

class OrderItmListResource extends JsonResource
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
		  $locale=app()->getLocale(); 
          $arr['id'] = $this->resource->id;
          $arr['item_name'] = $this->resource->item_name;


          $properties=$this->resource->properties;
            $propItmes=array();
            if(empty($properties)==false){
                        foreach( $properties as $kkeyy => $propItms){
						 
                              $propItmes[]=$propItms['attr_name'].' : '.$propItms['attr_value'];
                        }
            }
     
          $arr['properties'] = $propItmes;

          $arr['quantity'] = $this->resource->quantity;
          $arr['total'] = getPrice($this->resource->total);
       
          return $arr;
    }
}
