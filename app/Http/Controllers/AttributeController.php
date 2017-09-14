<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Event;
use App\Framework\DataGrid\Facades\DataGrid;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use App\Events\AttributeSavedEvent;

class AttributeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dataGrid = DataGrid::model(Attribute::query())
            ->column('name',['label' => 'Name','sortable' => true])
            ->column('identifier',['sortable' => true])
            ->linkColumn('edit',[], function($model) {
                return "<a href='". route('attribute.edit', $model->id)."' >Edit</a>";

            })->linkColumn('destroy',[], function($model) {
                return "<form id='admin-attribute-destroy-".$model->id."'
                                            method='POST'
                                            action='".route('attribute.destroy', $model->id) ."'>
                                        <input name='_method' type='hidden' value='DELETE' />
                                        ". csrf_field()."
                                        <a href='#'
                                            onclick=\"jQuery('#admin-attribute-destroy-$model->id').submit()\"
                                            >Destroy</a>
                                    </form>";
            });
        return view('attribute.index')->with('dataGrid', $dataGrid);
    }

    public function create()
    {
        return view('attribute.create');
    }

    public function store(AttributeRequest $request)
    {
        $attribute = Attribute::create($request->all());
        Event::fire(new AttributeSavedEvent($attribute, $request));
        return redirect()->route('attribute.index');
    }

    public function edit($id)
    {
        $attribute = Attribute::find($id);
        return view('attribute.edit')->with('attribute', $attribute);
    }

    public function update(AttributeRequest $request, $id)
    {
        $attribute = Attribute::find($id);
        $attribute->update($request->all());
        Event::fire(new AttributeSavedEvent($attribute, $request));
        return redirect()->route('attribute.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Attribute::destroy($id);
        return redirect()->route('attribute.index');
    }
}
