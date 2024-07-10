<?php

use Illuminate\Support\Facades\Route;
use Modules\Post\Http\Controllers\CategoryController;
use Modules\Post\Http\Controllers\PostController;

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

Route::prefix('admin')->middleware('auth:admin-api')->group(function() {

    Route::Resource('categories',CategoryController::class);

    // Route::apiResource('posts',PostController::class);
    // Route::delete('media/{media}',[MediaController::class, 'destroy']);
});
// Route::name('api')->prefix('front')->group(function() {

//     Route::get('/products', [\Modules\Product\Http\Controllers\Front\ProductController::class,'index']);
//     Route::get('/products/{product}', [\Modules\Product\Http\Controllers\Front\ProductController::class,'show']);
//     Route::get('/categories', [\Modules\Product\Http\Controllers\Front\CategoryController::class,'index']);
// });
