<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use App\Framework\DataGrid\Facades\DataGrid;

class AttributeController extends Controller
{
    public function getDataGrid()
    {
        return $users = DataGrid::dataTableData(Attribute::query())->get();
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

        $this->_saveDropdownOptions($attribute , $request);

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


        $this->_saveDropdownOptions($attribute, $request);

        return redirect()->route('attribute.index');

    }

    /**
     *
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {

        Attribute::destroy($id);

        return redirect()->route('attribute.index');
    }


    public function getAttribute(Request $request)
    {
        $attribute = Attribute::findorfail($request->get('id'));

        return view('attribute.attribute-card-values')
            ->with('attribute', $attribute);

    }


    private function _saveDropdownOptions($attribute, $request)
    {

        if (null !== $request->get('dropdown-options')) {

            foreach ($request->get('dropdown-options') as $key => $val) {
                if ($key == '__RANDOM_STRING__') {
                    continue;
                }
                if (!is_int($key)) {
                    $attribute->attributeDropdownOptions()->create($val);
                }
            }
        }
    }
}
