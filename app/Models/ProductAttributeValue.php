<?php

namespace App\Models;

class ProductAttributeValue extends Model
{
	protected $fillable = ['attribute_id', 'product_id' ,'value'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }
}
