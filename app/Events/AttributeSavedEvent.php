<?php
namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Models\Attribute;
use App\Http\Requests\AttributeRequest;

class AttributeSavedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $attribute = null;
    public $request = null;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Attribute $attribute
     * @param \App\Http\Requests\AttributeRequest $request
     */
    public function __construct(Attribute $attribute, AttributeRequest $request)
    {
        $this->attribute = $attribute;
        $this->request = $request;
    }
}
