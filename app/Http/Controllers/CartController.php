<?php

namespace App\Http\Controllers;

use Request;
use DB;
use Cart;
use App\Product;
use Input;
use App\Guest;
use App\Address;
use App\Transaction;
use App\Sale;
use Auth;
use App\User;
use PDF;

class CartController extends Controller
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

    public function store_guest(){
    	if(Request::ajax()){
    		$data = Input::all();
    		$guest = new Guest();
    		$address = new Address();
    		foreach ($data as $key => $value) {
    			
	    			$case = $key;

				switch ($key) {
			    case "name":
			        $guest->name = $value;
			        break;
			    case "email":
			        $guest->email = $value;
			        break;
			    case "phone":
			        $guest->phone = $value;
			        break;
			    case "address":
			    	 $address->address = $value;
			    	break;
			    case "landmark":
			    	 $address->landmark = $value;
			    	 break;
			    case "LGA":
			    	 $address->LGA = $value;	 	   
			    default:
			        echo "";
					}
    		}
	    		$guest->save();
	    		$transaction = new Transaction();
	    		$transaction->user_id = $guest->id;
	    		$transaction->save();
	    		$address->user_id = $guest->id;
	    		$address->save();
	    		session(['guest_id' => $guest->id]);
	    		print_r(json_encode([$guest, $address, $transaction]) );die;
    	}
    }

    public function  record_sale($id){
    	$transaction = Transaction::find($id);
    	$transaction->status = "Success";
    	$address = Address::where(['user_id' => $transaction->user_id, 'type' => 'guest'])->get();
    	//$address = Address::where('user_id' , $transaction->user_id)->get();
    	// dd($address);
    	
    	// dd($cart_total);
    	// foreach ($address as $address) {
    	// if ($address->LGA != 'Jos-North' && $address->LGA != 'Jos-South' && $address->LGA != 'Jos-East'){
    	//  	$transaction->total = $cart_total + 1000;

    	//  }
    	//  else{
    	//  	$transaction->total = $cart_total + 500;
    	//  }
    	// }
    	 
    	 $transaction->save();
    	//store cart items 
    	foreach (Cart::content() as $item) {
    		$sale = new Sale();
    		$sale->product_id = $item->id;
    		$sale->name = $item->name;
    		$sale->quantity = $item->qty;
    		$sale->total = $item->qty * $item->price;
    		$sale->transaction_id = $id;
    		$sale->save();
    	}
    
    	return redirect(route('confirm', $id));
    }

    public function confirm($id){

    	$transaction = Transaction::find($id);

    	return view('sale.confirm', compact('transaction'));
    }

    public function store_price(){
    	if(Request::ajax()){
    		$data = Input::all();
    		foreach ($data as $key => $value) {
    			if($key == 'transaction_id'){
    				$transaction_id = $value;
    			}
    			else if ($key == 'total') {
    				$total = $value;
    			}
    			
    		}
    		$transaction = Transaction::find($transaction_id);
    		$transaction->total = $total;
    		$transaction->save();
    		print_r($transaction);die;
    	}
    }

    public function invoice($id){
    	$transaction = Transaction::find($id);
    	if($transaction->type == 'guest'){
    		$user = Guest::find($transaction->user_id);
    		$LGA = DB::table('addresses')->where(['user_id' => $transaction->user_id, 'type' => 'guest'])->get();
    		if($LGA != 'Jos-North' && $LGA != 'Jos-East' && $LGA != 'Jos-South'){
    			$delivery_cost = 1000;
    		}
    		else{
    			$delivery_cost = 500;
    		}
    	}
    	else{
    		$user = User::find($transaction->user_id);
    		$LGA = DB::table('addresses')->where(['user_id' => $transaction->user_id, 'type' => 'user'])->get();
    		if($LGA != 'Jos-North' && $LGA != 'Jos-East' && $LGA != 'Jos-South'){
    			$delivery_cost = 1000;
    		}
    		else{
    			$delivery_cost = 500;
    		}
    	}

    	$sales = $transaction->sale()->get();
        $pdf = PDF::loadView('sale.invoice', compact('transaction', 'user', 'sales', 'delivery_cost'));
    	return $pdf->download('invoice.pdf');
    }

}
