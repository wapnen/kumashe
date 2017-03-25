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
Route::get('/new' , 'ProductController@new_product');
Route::post('/add_to_cart/{id}', 'ProductController@add_to_cart');
Route::resource('/product', 'ProductController');