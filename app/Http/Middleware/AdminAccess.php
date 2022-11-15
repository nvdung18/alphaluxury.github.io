<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    { 
        $token = Cookie::get('token');
        if(isset($request->status)) {
            return $next($request);
        }
        if (isset($token) && $token != null) {
            return $next($request);
        } 
        return redirect()->route('loginadmin')->with([
            'message' => 'Please Login To Access Admin'
        ]);
    }
}
