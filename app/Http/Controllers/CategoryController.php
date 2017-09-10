<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index');
    }


    /**
     * Show the form for creating a new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Category\Requests\CategoryRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {

        Category::create($request->all());

        return redirect()->route('category.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findorfail($id);

        return view('category.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Category\Requests\CategoryRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findorfail($id);
        $category->update($request->all());

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        foreach ($category->children as $child) {
            $child->parent_id = 0;
            $child->update();
        }

        $category->delete();

        return redirect()->route('category.index');
    }
}
