<?php

Route::get('/', 'PageController@index')->name('index');
Route::get('/home', 'PageController@home')->name('home');

Auth::routes();

Route::resource('/category', 'CategoryController');
Route::resource('/attribute', 'AttributeController');
Route::post('/attribute-option/add', [
    'as' => 'attribute.add-option', 'uses' => 'AttributeController@addOption',
]);


Route::resource('/product', 'ProductController');
Route::post('/product-image/upload', [
    'as' => 'product.upload-image', 'uses' => 'ProductController@uploadImage',
]);
Route::post('/product-image/delete', [
    'as' => 'product.delete-image', 'uses' => 'ProductController@deleteImage',
]);
