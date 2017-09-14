<?php

namespace App\ViewComposers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryTreeComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', (new Category)->getAllCategories());
    }
}
