<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//Class needed for login and Logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    //
    protected $redirectTo = '/admin/home';

    use AuthenticatesUsers;

    protected function guard(){
    	return Auth::guard('admin_guard');
    }

    public function show(){
    	return view('admin.auth.login');
    }
}
