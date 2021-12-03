<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //validasi request yang masuk
        request()->validate([
            'email' => ['required', 'email', 'unique:users'],
            'name' => ['required', 'string', 'min:3', 'max:25'],
            'password' => ['required', 'min:8', 'max:25'],
        ]);


        //store dalam database
        User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);


        //redirect ke post
        return redirect(route('posts.index'));
    }
}
