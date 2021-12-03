<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerPost(RegistrationRequest $request)
    {
        //validasi request yang masuk
        //untuk validasi nya, lihat di file app\Http\Requests
        $account = $request->all();

        //hash dulu password nya sebelum masuk database
        $account['password'] = Hash::make($request->password);

        //store dalam database
        User::create($account);


        //redirect ke post
        return redirect()->route('posts.index')->with('success', 'You are registered');
    }
}
