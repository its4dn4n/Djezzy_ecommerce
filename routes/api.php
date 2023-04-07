<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;


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

   //users
   Route::get('user',[UserController::class,'show']);
   Route::post('user/update',[UserController::class,'update']);
   Route::delete('user',[UserController::class,'destroy']);
   Route::get('logout',[UserController::class,'logout']);

   
    
   /*
    
    // OTHERS
    Route::apiResource('categories',CategorieController::class);
    //CREATE , UPDATE , DESTROY ,  SHOW ALL , SHOW 
    // show products of category 
    Route::apiResource('products',CategorieController::class);
    // CREATE , update , destroy ,show 
    //!(show all)
    Route::apiResource('orders',CategorieController::class);
    // create, destroy  
    Route::apiResource('carts',CartController::class);
    // create ,update ,checkout , destroy ,show
    Route::apiResource('feedbacks',CategorieController::class);
    //create, update,  destroy 
    */
});

Route::post('user',[UserController::class,'store']);

