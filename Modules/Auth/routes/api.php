<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::name('api')->prefix('admin')->middleware('guest')->group(function() {
    Route::post('/login',[AuthController::class,'login']);
});
Route::name('api')->prefix('admin')->middleware('auth:admin-api')->group(function() {
    Route::post('/logout',[AuthController::class,'logout']);
});
