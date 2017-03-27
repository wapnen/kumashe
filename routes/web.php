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

Route::get('/home', 'HomeController@index');
Route::get('/address', 'UserController@create_address');
Route::post('/store_address', ['uses' => 'UserController@store_address', 'as' => 'store_address']);
Route::get('/profile', 'UserController@index');
Route::post('/add_to_cart/{id}', 'ProductController@add_to_cart');
Route::post('/edit_cart/{id}', 'ProductController@edit_cart');
Route::get('/remove_cart_item/{id}', 'ProductController@remove_cart_item');
Route::get('/cart', 'ProductController@cart');
Route::resource('/product', 'ProductController');

Route::group(['middleware' => 'admin_guest'] , function(){

	Route::get('/admin/register' , 'AdminAuth\RegisterController@show');
	Route::post('/admin/register', 'AdminAuth\RegisterController@register');
	Route::get('/admin/login', 'AdminAuth\LoginController@show');
	Route::post('/admin/login', 'AdminAuth\LoginController@login');
});

Route::group(['middleware' => 'admin_auth'], function(){
	Route::get('/admin/home', function(){
	return view('admin.home');
		});
	Route::post('/admin/logout', 'AdminAuth\LoginController@logout');

});

Route::get('/checkout', function(){
	return view('sale.checkout');
});

