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



Route::get('/', 'ProductController@index');

Auth::routes();

Route::get('/products', 'ProductController@index')->name('home');
Route::get('/products/{id}', 'ProductController@show');
Route::get('/cart', 'CartController@index');
Route::get('/cart/{id}', 'CartController@store');
Route::get('/cart/delete/{id}', 'CartController@destroy');
Route::post('/cart/update/{id}', 'CartController@update');
Route::get('/cart/total/{id}', 'CartController@getTotal');
Route::get('/shipping', 'ShippingController@create');
Route::post('/shipping', 'ShippingController@store');
Route::get('/order/confirmation', 'OrderController@checkout');
Route::get('/order/summary', 'OrderController@store');
Route::get('/admin/orders/status/{id}/{status}', 'OrderController@update');
Route::get('/orders', 'OrderController@show');



Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/home', 'AdminController@index');
    Route::get('/admin/create', 'ProductController@create');
    Route::post('/admin/product', 'ProductController@store');
    Route::get('/admin/products', 'AdminController@showProducts');
    Route::get('/admin/product/update/{id}', 'ProductController@edit');
    Route::post('/admin/product/update/{id}', 'ProductController@update');
    Route::post('/admin/products/{id}', 'AdminController@destroy');
    Route::get('/admin/users', 'AdminController@showUsers');
    Route::get('/admin/users/{id}', 'UserController@show');
    Route::get('/admin/orders', 'OrderController@index');
});

// Route::delete('users/{id}', CartController);
