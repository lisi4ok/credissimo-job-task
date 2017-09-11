<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Framework\DataGrid\Facades\DataGrid;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
        $this->middleware('guest')->only('show');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataGrid = DataGrid::model(Category::query())
                        ->column('name',['label' => 'Name','sortable' => true])
                        ->column('slug',['sortable' => true])
                        ->linkColumn('edit',[], function($model) {
                            return "<a href='". route('category.edit', $model->id)."' >Edit</a>";

                        })->linkColumn('destroy',[], function($model) {
                            return "<form id='admin-category-destroy-".$model->id."'
                                            method='POST'
                                            action='".route('category.destroy', $model->id) ."'>
                                        <input name='_method' type='hidden' value='DELETE' />
                                        ". csrf_field()."
                                        <a href='#'
                                            onclick=\"jQuery('#admin-category-destroy-$model->id').submit()\"
                                            >Destroy</a>
                                    </form>";
                        });

        return view('category.index')->with('dataGrid', $dataGrid);
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
     * @param \App\Http\Requests\CategoryRequest $request
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
     * @param \App\Http\Requests\CategoryRequest $request
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
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $category = Category::where('slug', '=', $slug)->get()->first();

        echo '<pre>';
        var_dump($category);
        exit;

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
