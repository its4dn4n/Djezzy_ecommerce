<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

//relationships 
  function users(){
    $this->belongsTo(User::class);
  }
  function products(){
    $this->belongsToMany(Product::class); //auto 
  }
}
