<?php
namespace App\Listeners;

use App\Models\Attribute;

class AttributeSavingListener
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle($event)
    {
        $attribute = $event->attribute;
        $request = $event->request;
        if (null !== $request->get('dropdown-options')) {
            foreach ($request->get('dropdown-options') as $key => $value) {
                if ($key == '__RANDOM_STRING__') {
                    continue;
                }
                if (!is_int($key)) {
                    $attribute->attributeDropdownOptions()->create($value);
                }
            }
        }
    }
}
