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
use App\Product;

Route::get('/', function () {
	$products = Product::limit(6)->get();
    return view('welcome', compact('products'));
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/address', 'UserController@create_address');
Route::post('/store_address', ['uses' => 'UserController@store_address', 'as' => 'store_address']);
Route::get('/profile', 'UserController@index');
Route::post('/edit_user', 'UserController@edit_user');
Route::post('/add_to_cart/{id}', 'CartController@add_to_cart');
Route::post('/edit_cart/{id}', ['uses' => 'SaleController@edit_cart' , 'as' => 'edit_cart']);
Route::get('/remove_cart_item/{id}', 'CartController@remove_cart_item');
Route::post('/guest/store_guest', 'CartController@store_guest');
Route::post('guest/store_price', 'CartController@store_price');
Route::post('user/store_price', 'CartController@store_price_user');
Route::get('/invoice/{id}' , 'CartController@invoice');
Route::get('/record_sale/{id}', ['uses' => 'CartController@record_sale', 'as' => 'record_sale']);
Route::get('/confirm/{id}', ['uses' => 'CartController@confirm', 'as' => 'confirm']);
Route::get('/cart', 'CartController@cart');
Route::get('/transactions', 'ProductController@transactions');
Route::get('/transaction/{id}', 'ProductController@transaction');
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
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/guest/checkout', function(){
	$id_array = [];

        foreach (Cart::content() as $key) {
            $id_array[] = $key->id;
        }
        $cartitems = DB::table('products')->whereIn('id', $id_array)->get();
      
	return view('sale.checkout', compact('cartitems'));
});

Route::get('/user/checkout', function(){
	$id_array = [];

        foreach (Cart::content() as $key) {
            $id_array[] = $key->id;
        }
        $cartitems = DB::table('products')->whereIn('id', $id_array)->get();
      
        $address = DB::table('addresses')->where(['user_id' => Auth::user()->id, 'type' => 'user'])->get();
    
        foreach ($address as $key => $value) {
           
           $address = $value;
        }

        if($address->LGA != 'Jos-South' && $address->LGA != 'Jos-North' && $address->LGA != 'Jos-East'){
        	$delivery_cost = 1000;
        }
        else{
        	$delivery_cost = 500;
        }


	return view('sale.user_checkout', compact('cartitems', 'address', 'delivery_cost'));
});



