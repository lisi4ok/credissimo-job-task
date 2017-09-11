<?php

namespace App\Listeners;

class ProductCategorySavingListener
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

        if (count($request->get('category_id')) > 0) {
            $product->categories()->sync($request->get('category_id'));
        }
        /**
         * @todo  Remove if no categories
         */
    }
}
