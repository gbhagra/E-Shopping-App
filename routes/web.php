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

use App\Http\Controllers\CartController;

Route::get('/','ProductController@index' );

Auth::routes();

Route::get('/products', 'ProductController@index')->name('home');
Route::get('/products/{id}', 'ProductController@show');
Route::get('/cart', 'CartController@index');
Route::get('/cart/{id}', 'CartController@store');
Route::get('/cart/delete/{id}','CartController@destroy');
Route::post('/cart/update/{id}','CartController@update');
Route::get('/shipping','ShippingController@create');
Route::post('/shipping','ShippingController@store');
Route::get('/order/confirmation','OrderController@checkout');

// Route::delete('users/{id}', CartController);

