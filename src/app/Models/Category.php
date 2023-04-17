<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable=[
      'name',
    ];
    

 // with user is it nessecary ? also in uml ?
 //relationships 
 function products(){
    $this->hasMany(Product::class);
   }
   
}
