<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ProductAttribute;
use App\Models\AttributesValue;
use App\Models\Attribute;
use App\Http\Resources\CartItemResource;

class CartResource extends JsonResource
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
         $arr['shipping_price'] = $this->resource->quantity;
         $arr['total'] = getPrice($this->resource->total); 
         $arr['grand_total'] = getPrice( $this->resource->grand_total);
         $arr['shipping_title'] = $this->resource->shipping_title;
         $arr['shipping_price'] = getPrice( $this->resource->shipping_price);
         $arr['cart_items'] = CartItemResource::collection($this->items);
         $arr['quantity'] =  $this->resource->quantity; 
          return $arr;
    }
}
