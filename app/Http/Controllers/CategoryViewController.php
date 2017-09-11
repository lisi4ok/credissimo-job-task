<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryViewController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request, $slug)
    {
        $category = Category::where('slug', '=', $slug)->get()->first();

        echo '<pre>';
        var_dump($category);
        exit;

    }
}
