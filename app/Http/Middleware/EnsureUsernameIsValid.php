<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUsernameIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  Route_Binding $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //jika username di parameter tidak sama dengan username yang lagi login saat ini, redirect
        if($request->username !== Auth::user()->username) {
            return redirect()->route('blog.index')->with('error', 'Error Occured. Please Try Again.');
        }
        
        return $next($request);
    }
}
