<?php

use Illuminate\Support\Facades\Route;
// use Modules\Product\Http\Controllers\ProductController;
use Modules\Product\Http\Controllers\Session\ProductController;

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

Route::prefix('/dashboard')->group(function(){
    Route::middleware(['auth', 'role:Admin|User'])->group(function(){
        

        Route::resource('/products', ProductController::class);

    });
});

