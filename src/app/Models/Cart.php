<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;


 //relationships 
 function users(){
    $this->belongTo(User::class);
   }
 function products(){
    $this->belongToMany(Product::class); //auto 
   }

}
