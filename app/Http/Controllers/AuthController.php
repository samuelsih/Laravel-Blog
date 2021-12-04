<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        //$request->only mengecek email dan password dengan Validate di folder Requests/LoginRequest
        $accounts = $request->only(['email', 'password']);

        //jika validasi berhasil, redirect ke post
        if(Auth::attempt($accounts)){
            return redirect()->route('posts.index');
        }

        //jika tidak, throw error ke login.blade.php
        throw ValidationException::withMessages([
            'email' => 'Login failed. Try again',
        ]);

        return redirect()->route('posts.index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
