<?php

namespace App\Models;

class ProductAttributeValue extends Model
{
	protected $fillable = ['attribute_id', 'product_id' ,'value'];

    /**
     * Attribute Drop down Options belongs to many Product Attribute.
     *
     * @return \App\Models\Attribute
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    /**
     * Attribute Drop down Options belongs to many Product Attribute.
     *
     * @return \App\Models\Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
