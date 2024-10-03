<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ProductAttribute;
use App\Models\AttributesValue;
use App\Models\Attribute;

class ProductModalResource extends JsonResource
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
         
		$productAttrs = ProductAttribute::where('product_id','=', $this->id) ->get();
	$locale=app()->getLocale() ;
	
	$attrs=[];
		foreach($productAttrs  as $key=> $prodAttrItm){
			 $attrbuite= Attribute::where('id',$prodAttrItm->attr_id)->get()->first();
			 $attrs[$key]['name'] =$attrbuite->name;
			 $attrs[$key]['id'] =$attrbuite->id;
				
				$attrValues=AttributesValue::where('attribute_id',$prodAttrItm-> attr_id)->get()->toArray();
				$attrValuesArr = [];
				foreach($attrValues as $keya=>$attrVal){
					$attrValuesArr[$keya]['attribute_id']= $attrVal['attribute_id'];
					$attrValuesArr[$keya]['attribute_value']= $attrVal['attribute_value'][$locale]	;;
					$attrValuesArr[$keya]['id']= $attrVal['id'];;
					$attrValuesArr[$keya]['isSelected']= true;
				}
			 $attrs[$key]['values'] = $attrValuesArr;
		}
			
      $getSizes =  $this->resource->sizes()->get();
			$setSize=[];
			foreach($getSizes as $keya => $sizeItm){
				$prodName=(array) json_decode($sizeItm->name);
					$setSize[$keya]['name']= $prodName[$locale];
					$setSize[$keya]['id']=$sizeItm->id;
					$setSize[$keya]['price']= getPrice($sizeItm->price);
					$setSize[$keya]['product_id']=$sizeItm->product_id;
					$setSize[$keya]['size_id']=$sizeItm->size_id;
			}
			  
            $arr['sizes'] = $setSize;
			
			$subProducts= $this->resource->subProducts()->get();
			$subProductsArr=[];
			
			foreach($subProducts as $kkeyy => $subProductsItm){
				$subProdName=(array) json_decode($subProductsItm->name);
				 $subProductsArr[$kkeyy]['name']= $subProdName[$locale];
				 $subProductsArr[$kkeyy]['price']= getPrice($subProductsItm->price);
				 $subProductsArr[$kkeyy]['id']= $subProductsItm->sub_product_id;
			}
			
            $arr['attributes'] =  $attrs;
            $arr['sub_products'] = $subProductsArr;
           $arr['img_path'] = $this->resource->mainImage()->imageObj()->first()->path;
         
          return $arr;
    }
}
