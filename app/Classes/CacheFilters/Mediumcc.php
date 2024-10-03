<?php

namespace App\Classes\CacheFilters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Mediumcc implements FilterInterface
{
    /**
     * @param  \Intervention\Image\Image  $image
     * @return \Intervention\Image\Image
     */
    public function applyFilter(Image $image)
    {
        $width = $height = 280;

        $image->resize($width, $height);
// Set a custom cache key
/* $cacheKey = 'custom_cache_key';

// Save the manipulated image with the custom cache key
$image->cache(['key' => $cacheKey]); */

		return $image;
     //   return $image->resizeCanvas($width, $height, 'center', false, '#fff');
    }
}