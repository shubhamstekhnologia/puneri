<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
class Products extends Eloquent
{
  use SoftDeletes;
    protected $connection = 'mongodb'; 
    protected $collection = 'products';
    
    protected $fillable = [
        
    ];
}
