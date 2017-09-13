<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Framework\DataGrid\Facades\DataGrid;
use App\Framework\Image\Facades\Image;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductAttributeValue;
use App\Models\Attribute;
use App\Events\ProductSavedEvent;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
        $this->middleware('guest')->only('show');
    }
    /**
     * Display a listing of the resource.
     * r.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataGrid = DataGrid::model(Product::query()->orderBy('id','desc'))
            ->column('id',['sortable' => true])
            ->column('name')
            ->linkColumn('edit',[], function($model) {
                return "<a href='". route('product.edit', $model->id)."' >Edit</a>";

            })->linkColumn('destroy',[], function($model) {
                return "<form id='admin-product-destroy-".$model->id."'
                                            method='POST'
                                            action='".route('product.destroy', $model->id) ."'>
                                        <input name='_method' type='hidden' value='DELETE' />
                                        ". csrf_field()."
                                        <a href='#'
                                            onclick=\"jQuery('#admin-product-destroy-$model->id').submit()\"
                                            >Destroy</a>
                                    </form>";
            });

        return view('product.index')->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attirbutes = Attribute::where('field_type', 'TEXT')->get();
        return view('product.create')->with('attirbutes', $attirbutes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            $product = Product::create($request->all());

            $rq = $request->all();
            $attirbutes = Attribute::where('field_type', 'TEXT')->get();
            $attributesToSave = [];
            foreach ($attirbutes as $attirbute) {
                if (array_key_exists($attirbute->identifier, $rq)) {
                    $attributesToSave[$attirbute->id] = $rq[$attirbute->identifier];
                }
            }
            foreach ($attributesToSave as $attrid => $value) {
                \DB::table('product_attribute_values')->insert([
                    'attribute_id' => $attrid,
                    'value' => $value,
                    'product_id' => $product->id,
                ]);
            }

            Event::fire(new ProductSavedEvent($product, $request));
        } catch (\Exception $e) {
            echo 'Error in Saving Product: ', $e->getMessage(), "\n";
        }

        return redirect()->route('product.edit', ['id' => $product->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param sting $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', '=', $slug)->get()->first();
        $attributes = \DB::table('attributes')
            ->leftJoin(
                'product_attribute_values',
                'product_attribute_values.attribute_id',
                '=', 'attributes.id'
            )
            ->where('product_attribute_values.product_id', $product->id)
            ->get();

        return view('product.show')
        ->with('attributes', $attributes)
        ->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attributes = \DB::table('attributes')
            ->leftJoin(
                'product_attribute_values',
                'product_attribute_values.attribute_id',
                '=', 'attributes.id'
            )
            ->where('product_attribute_values.product_id', $id)
            ->get();
        $product = Product::findorfail($id);
        return view('product.edit')
            ->with('product', $product)
            ->with('attributes', $attributes);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        try {
            $product = Product::findorfail($id);
            $product->update($request->all());

            $rq = $request->all();
            $attirbutes = Attribute::where('field_type', 'TEXT')->get();
            $attributesToSave = [];
            foreach ($attirbutes as $attirbute) {
                if (array_key_exists($attirbute->identifier, $rq)) {
                    $attributesToSave[$attirbute->id] = $rq[$attirbute->identifier];
                }
            }
            foreach ($attributesToSave as $attrid => $value) {
                $hasAttrVal = DB::table('product_attribute_values')
                    ->where('product_id', $product->id)
                    ->where('attribute_id', $attrid)
                    ->get();
                if($hasAttrVal) {
                    \DB::table('product_attribute_values')
                        ->where('product_id', $product->id)
                        ->where('attribute_id', $attrid)
                        ->update(['value' => $value]);
                } else {
                    \DB::table('product_attribute_values')->insert([
                        'attribute_id' => $attrid,
                        'value' => $value,
                        'product_id' => $id,
                    ]);
                }
            }

            Event::fire(new ProductSavedEvent($product, $request));
        } catch (\Exception $e) {
            throw new \Exception('Error in Saving Product: ' . $e->getMessage());
        }

        return redirect()->route('product.index');
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

        /**
         * @todo  destroy attribute valuesS
         */
        Product::destroy($id);

        return redirect()->route('product.index');
    }

    public function uploadImage(Request $request)
    {
        $image = $request->file('image');
        $tmpPath = str_split(strtolower(str_random(3)));
        $checkDirectory = '/uploads/catalog/images/' . implode('/', $tmpPath);

        $dbPath = $checkDirectory . DIRECTORY_SEPARATOR . $image->getClientOriginalName();

        $image = Image::upload($image, $checkDirectory);

        $tmp = $this->_getTmpString();

        return view('product.upload-image')
            ->with('image', $image)
            ->with('tmp', $tmp);
    }

    public function deleteImage(Request $request)
    {
        $path = $request->get('path');

        if (File::exists($path)) {
            File::delete(public_path() . $path);
        }

        return 'success';
    }

    public function _getTmpString($length = 6)
    {
        $pool = 'abcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }
}
