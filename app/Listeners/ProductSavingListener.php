<?php
namespace App\Listeners;

use App\Models\ProductImage;
use App\Models\Product;

class ProductSavingListener
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle($event)
    {
        $product = $event->product;
        $request = $event->request;
        if (null !== $request->get('image')) {
            $exitingIds = $product->images()->get()->pluck('id')->toArray();
            foreach ($request->get('image') as $key => $data) {
                if (is_int($key)) {
                    if (($findKey = array_search($key, $exitingIds)) !== false) {
                        $productImage = ProductImage::findorfail($key);
                        $productImage->update($data);
                        unset($exitingIds[$findKey]);
                    }
                    continue;
                }
                ProductImage::create($data + ['product_id' => $product->id]);
            }
            if (count($exitingIds) > 0) {
                ProductImage::destroy($exitingIds);
            }
        }
    }
}
