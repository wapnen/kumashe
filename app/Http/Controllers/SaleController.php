<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

class SaleController extends Controller
{
    //
	   public function edit_cart(Request $request, $rowId){
       
        Cart::update($rowId, $request->quantity);
        return redirect(url('/cart'));
    }
 
}
