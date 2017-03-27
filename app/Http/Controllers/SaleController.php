<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaleController extends Controller
{
    //

    public function add_to_cart($id){
        if(Request::ajax()) {
         $data = Input::all();
         foreach ($data as $key => $value) {
             if($key == 'id'){
                $product_id = $value;

             }
         }
         $product = Product::find($product_id);
         
         Cart::add($product);
         print_r(Cart::content());
        //print_r($data);die;
         }
        
    }

    public function edit_cart($id){

        Cart::update($rowId, $request->quantity);
        return redirect(url('/cart'));
    }

    public function remove_cart_item($id){

         Cart::remove($rowId);
         return redirect(url('/cart'));
    }

    public function cart(){
      //  dd(Cart::content());
        $id_array = [];

        foreach (Cart::content() as $key) {
            $id_array[] = $key->id;
        }
        $cartitems = DB::table('products')->whereIn('id', $id_array)->get();
      
        return view('product.cart', compact('cartitems'));
    }
}
