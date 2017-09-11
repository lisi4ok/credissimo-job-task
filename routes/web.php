<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/category', 'CategoryController');
// Route::get('/category/{slug}', [
//     'as' => 'category.view', 'uses' => 'CategoryViewController@view',
// ]);

Route::resource('/product', 'ProductController');
Route::post('/product-image/upload', [
    'as' => 'product.upload-image', 'uses' => 'ProductController@uploadImage',
]);
Route::post('/product-image/delete', [
    'as' => 'product.delete-image', 'uses' => 'ProductController@deleteImage',
]);
// Route::get('/product/{slug}', [
//  'as' => 'product.view', 'uses' => 'ProductViewController@view',
// ]);


Route::resource('/attribute', 'AttributeController');
Route::post('product-attribute-panel', [
    'as' => 'product-attribute.get-attribute',
    'uses' => 'AttributeController@getAttribute',
]);
