<?php
namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductSavedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $product = null;

    public $request = null;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Product $product
     * @param \App\Http\Requests\ProductRequest $request
     */
    public function __construct(Product $product, ProductRequest $request)
    {
        $this->product = $product;
        $this->request = $request;
    }
}
