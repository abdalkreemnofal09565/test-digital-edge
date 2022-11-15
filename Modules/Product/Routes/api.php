<?php

use Illuminate\Support\Facades\Route;

use Modules\Product\Http\Controllers\Api\ProductController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware(['auth:sanctum','role:Admin|User'])->group(function(){
	Route::apiResource('/products', ProductController::class, ['as' => 'api']);
});
