<?php

use App\Http\Controllers\OtpController;
use App\Http\Controllers\Session\AuthController;
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

Route::get('/', function () {
    return view('basic.index');
});
Route::get('register', [AuthController::class, 'getRegister'])->name('register');
Route::get('login', [AuthController::class, 'getLogin'])->name('login')->middleware('guest');

Route::post('post-register', [AuthController::class, 'register'])->name('register.post');
Route::post('post-login', [AuthController::class, 'login'])->name('login.post');


Route::middleware(['auth', 'role:Customer'])->group(function(){
    Route::get('home', function(){
        return view('basic.home');
    })->name('home');
    Route::get('change-password', [AuthController::class, 'changePasswordShowForm'])->name('change.password.show.form');
    Route::post('change-password', [AuthController::class, 'changePassword'])->name('change.password');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

/**
 * 
 * dashboard routes
 * 
 */
Route::prefix('/dashboard')->group(function(){

    Route::get('login', [AuthController::class, 'getDashboardLogin'])->name('dashboard.login')->middleware('guest');
    Route::post('post-login', [AuthController::class, 'loginDashboard'])->name('dashboard.login.post');
    Route::get('change-password', [AuthController::class, 'changePasswordShowForm'])->name('dashboard.change.password.show.form');
    Route::post('change-password', [AuthController::class, 'changePassword'])->name('dashboard.change.password');
    Route::middleware(['auth', 'role:Admin|User'])->group(function(){
        Route::get('/', function(){
            return view('dashboard.dashboard');
        })->name('dashboard');

        Route::post('logout', [AuthController::class, 'logoutDashboard'])->name('dashboard.logout');
  });
    
});


Route::get('otp', [OtpController::class, 'otp']);
Route::post('post-recaptcha', [OtpController::class, 'postRecaptcha'])->name('post.re');