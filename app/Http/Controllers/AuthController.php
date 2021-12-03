<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $accounts = $request->only('email', 'password');

        if(Auth::attempt($accounts)){
            return redirect()->route('posts.index');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
