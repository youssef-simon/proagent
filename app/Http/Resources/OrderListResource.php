<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ProductAttribute;
use App\Models\AttributesValue;
use App\Models\Attribute;

class OrderListResource extends JsonResource
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
	 
          $arr['name'] = $this->resource->id;
       
           $arr['price'] = getPrice($this->resource->price);
           $arr['total'] = getPrice($this->resource->total);
           $arr['grand_total'] = getPrice($this->resource->grand_total);
     
			$arr['order_items'] =	OrderItmListResource::collection($this->resource->orderItems()->getModels());
            $arr['order_status'] = $this->resource->orderStatus()->first()->name;

            $jsonAddress = json_decode($this->resource->order_address);
          if(isset($jsonAddress[0])){
					$arr['first_name'] =   $jsonAddress[0]->first_name;
					$arr['last_name'] =   $jsonAddress[0]->last_name;

					$arr['city'] =   $jsonAddress[0]->city;
					$arr['phone'] =   $jsonAddress[0]->phone;
					$arr['address_line_1'] =   $jsonAddress[0]->address_line_1;
					$arr['address_line_2'] =   $jsonAddress[0]->address_line_2;

		  }


          return $arr;
    }
}
