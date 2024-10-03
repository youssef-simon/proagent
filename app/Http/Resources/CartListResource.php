<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ProductAttribute;
use App\Models\AttributesValue;
use App\Models\Attribute;

class CartListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

		 
	
          $arr['id'] = $this->resource->id;
          $arr['item_name'] = $this->resource->item_name;
          $arr['item_price'] = getPrice($this->resource->item_price); 
          $arr['parent'] =  $this->resource->parent_id; 
          
         $arr['customer_notes'] = $this->resource->customer_notes;
         $arr['quantity'] = $this->resource->quantity;
         $arr['total'] = getPrice($this->resource->total); 
         $arr['properties'] = $this->resource->properties;
         
          return $arr;
    }
}
