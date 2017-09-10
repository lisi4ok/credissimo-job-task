<?php

namespace App\Framework\Image\Facades;

use Illuminate\Support\Facades\Facade;

class Image extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'App\Framework\Image\ImageService';
    }
}
