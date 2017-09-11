<?php

namespace App\Models;

use App\Framework\Image\LocalImageFile;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'path', 'is_main_image'];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function getPathAttribute()
    {
        if (null === $this->attributes['path'] || empty($this->attributes['path'])) {
            return NULL;
        }
        $localImage = new LocalImageFile($this->attributes['path']);
        return $localImage;
    }
}
