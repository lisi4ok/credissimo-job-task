<?php

namespace App\Listeners;

use App\Models\Attribute;
use App\Models\ProductAttributeValue;

class ProductAttributeSavingListener
{
    /**
     * Handle the event.
     *
     * @param $event
     * @return void
     */
    public function handle($event)
    {
        $product = $event->product;
        $request = $event->request;

        $modules = $request->get('modules');

        if (isset($modules['attributes'])) {
            foreach ($modules['attributes'] as $identifier => $value) {
                $attribute = Attribute::where('identifier', '=', $identifier)->first();
                if ($value) {
                    $productAttributeValue = ProductAttributeValue::where('product_id', '=', $product->id)
                        ->where('attribute_id', '=', $attribute->id)
                        ->first();

                    if (null === $productAttributeValue) {
                        ProductAttributeValue::create([
                            'product_id' => $product->id,
                            'attribute_id' => $attribute->id,
                            'value' => $value,
                        ]);
                    } else {
                        $productAttributeValue->update(['value' => $value]);
                    }
                } else {
                    ProductAttributeValue::where('product_id', '=', $product->id)
                    ->where('attribute_id', '=', $attribute->id)
                    ->delete();
                }
            }
        }
    }
}
