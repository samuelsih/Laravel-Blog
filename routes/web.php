<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    
//Ketika user sudah login/register, tutup routes register dan login nya
//Untuk redirect nya ke arah mana, set di RouteServiceProvider
Route::middleware('guest')->group(function () {
    //Registration
    Route::get('/register', [RegistrationController::class, 'register'])->name('register');
    Route::post('/register', [RegistrationController::class, 'registerPost']);


    //Login
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

//Home dan post
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/', HomeController::class)->name('home');

//Dashboard

