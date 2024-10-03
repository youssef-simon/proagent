<?php



if(!function_exists('getPrice')){
		function getPrice($price){
			if(round($price)==0){
				return '';
			} else {
				return round($price,2).' LE'; 
			}
		}
}