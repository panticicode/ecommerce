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
/****NAMESPACE FOR CONTROLLER***/
/****PREFIX FOR URL***/
Route::get('/', 'FrontEndController@index')->name('index');
Route::get('/single/{id}', 'FrontEndController@single')->name('products.single');
Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard'], function(){
	Route::get('/', 'HomeController@index');

	Route::resource('products', 'ProductsController');
	Route::post('/cart/add', 'ShoppingController@add_to_cart')->name('cart.add');
	Route::get('/cart', 'ShoppingController@cart')->name('cart');
	Route::get('/cart/delete/{id}', 'ShoppingController@cart_delete')->name('cart.delete');
	Route::get('/cart/reduce/{id}/{qty}', 'ShoppingController@cart_reduce')->name('cart.reduce');
	Route::get('/cart/increase/{id}/{qty}', 'ShoppingController@cart_increase')->name('cart.increase');
	Route::get('/cart/rapid/add/{id}', 'ShoppingController@rapid_add')->name('cart.rapid.add');
	Route::get('/cart/checkout', 'CheckoutController@index')->name('cart.checkout');
	Route::post('/cart/checkout', 'CheckoutController@pay')->name('cart.checkout');
});

Auth::routes();


