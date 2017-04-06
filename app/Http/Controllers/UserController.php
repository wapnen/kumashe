<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Adress;

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
       return view('user.index');
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
        $address->save();
        return redirect(url('/profile'));

    }
}
