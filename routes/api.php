<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;


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

   // users
   Route::get('user',[UserController::class,'show']);
   Route::post('user/update',[UserController::class,'update']);
   Route::delete('user',[UserController::class,'destroy']);
   Route::get('logout',[UserController::class,'logout']);
    
    // Categories
    Route::apiResource('categories',CategoryController::class)->only('store','destroy')->middleware('isAdmin');
    Route::apiResource('categories',CategoryController::class)->only('index','show');
    Route::post('/categories/{id}',[CategoryController::class,'update'])->middleware('isAdmin');;// can we send body in put/patch 

/*
    // show products of category 
    Route::apiResource('products',ProductController::class);
    // CREATE , update , destroy ,show 
    //!(show all)

    Route::apiResource('orders',OrderController::class);
    // create, destroy  
    /*

    Route::apiResource('carts',CartController::class);
    // create ,update  , destroy ,show  ..checkout

    Route::apiResource('feedbacks',FeedbackController::class);
    //create, update,  destroy 
    */
});

Route::post('user',[UserController::class,'store']);

