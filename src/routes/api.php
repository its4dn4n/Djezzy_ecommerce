<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->group(function () {

   // Users
   Route::get('user',[UserController::class,'show']);
   Route::post('user/update',[UserController::class,'update']);
   Route::delete('user',[UserController::class,'destroy']);
   Route::get('logout',[UserController::class,'logout']);
    
    // Categories
    Route::apiResource('categories',CategoryController::class)->only('store','destroy')->middleware('isAdmin');
    Route::apiResource('categories',CategoryController::class)->only('index','show');
    Route::post('categories/{category}',[CategoryController::class,'update'])->middleware('isAdmin');;// can we send body in put/patch 

    // Products 
    Route::post('product',[ProductController::class,'store']);
    Route::post('product/update/{product}',[ProductController::class,'update']);
    Route::delete('product/{product}',[ProductController::class,'destroy']);
    Route::get('products',[ProductController::class,'index']);
    Route::get('product/{product}',[ProductController::class,'show']);

    //Cart 
    Route::post('cart/{product}',[CartController::class,'attach']); //{quantity} 
    Route::delete('cart/{product}',[CartController::class,'detach']); 

/*
     
     // Check out >> order , (cancel order with delay) 

 
     // fiter by category 
     // Search 
    
   
     Route::apiResource('feedbacks',FeedbackController::class);
     // CRUD
     */
});

Route::post('user',[UserController::class,'store']);

