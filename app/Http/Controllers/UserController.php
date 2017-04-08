<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use DB;
use Auth;
use Alert;
use App\User;

class UserController extends Controller
{
    //
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = DB::table('addresses')->where(['user_id' => Auth::user()->id, 'type' => 'user'])->get();
        //dd($address);
        foreach ($address as $key => $value) {
           
           $address = $value;
        }
       return view('user.index', compact('address'));
    }

    public function create_address()
    {
    	 return view('user.create_address');
    }

    public function store_address(Request $request){

        $this->validate($request, [
            'address' => 'required',
            'LGA' => 'required',
            ]);

        $address = new Address($request->all());
        $address->type = 'user';
        $address->user_id = Auth::user()->id;
        $address->save();
        return redirect(url('/profile'));

    }

    public function edit_user(Request $request){

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->phone  = $request->phone;
        $user->save();
        $address = Address::find($request->address_id);
        $address->address = $request->address;
        $address->landmark = $request->landmark;
        $address->LGA = $address->LGA;
        $address->save();

        Alert::success('Done!');
        return redirect(url('/profile'));
    }
}
