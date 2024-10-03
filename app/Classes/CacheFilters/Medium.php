<?php

namespace App\Classes\CacheFilters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Medium implements FilterInterface
{
    /**
     * @param  \Intervention\Image\Image  $image
     * @return \Intervention\Image\Image
     */
    public function applyFilter(Image $image)
    {
        $width = $height = 280;

        $image->resize($width, $height);

        return $image->resizeCanvas($width, $height, 'center', false, '#fff');
    }
}