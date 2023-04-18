<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

class CartController extends Controller
{
    use ResponseTrait;
    public function attach(Request $request,Product $product){
        
        $cart= Cart::where(['user_id'=> auth()->user()->id])->first;

        $cart->products()->attach($product, ['quantity'=>$request->quantity]); 

        return $this->responseSuccess(null,'Product attached to cart',200);
    }
    public function detach(Product $product){
       
        $cart= Cart::where(['user_id'=> auth()->user()->id])->first;

        $cart->products()->detach($product); 

        return $this->responseSuccess(null,'Product detached to cart',200);
    }
}
