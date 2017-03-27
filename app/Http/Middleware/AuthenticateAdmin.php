<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        //If request does not comes from logged in seller
       //then he shall be redirected to Seller Login page
       if (! Auth::guard('admin_guard')->check()) {
           return redirect('/admin/login');
       }
        return $next($request);
    }
}
