<?php

namespace App\ViewComposers;

use App\Models\Attribute;
use Illuminate\View\View;

class ProductAttributesComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $attributes = Attribute::all();
        $view->with('attributes', $attributes);
    }

}
