<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
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


//saat di route ini, pastikan user lain tidak bisa mengakses username lain yang berbeda dengan user
//maka tambahkan custom middleware isValidUsername (lihat di file middleware EnsureUsernameIsValid)
Route::resource('/users/{username}/posts', DashboardController::class)
->except('show')
->middleware(['auth', 'isValidUsername']);


//logout user
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


//Home dan post
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/', HomeController::class)->name('home');



