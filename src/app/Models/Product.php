<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    
    // public $status; punding, done , .. 

    protected $fillable = [
       'name',
       'imagePath',
       'quantity',
       'price',
       'description',
       'category_id'
    ];

 //relationships 
 function categories(){
    $this->belongsTo(Categorie::class);
   }
 function carts(){
    $this->belongsToMany(Cart::class); //auto
   }
 function orders(){
    $this->belongsToMany(Order::class);
   }
}
