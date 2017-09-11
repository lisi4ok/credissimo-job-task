<?php

namespace App\ViewComposers;

use App\Models\Category;
use Illuminate\View\View;

class ProductFieldsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $categoryOptions = Category::pluck('name', 'id');
        $view->with('categoryOptions', $categoryOptions);
    }

}
