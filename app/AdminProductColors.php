<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
class AdminProductColors extends Eloquent
{
  use SoftDeletes;
    protected $connection = 'mongodb'; 
    protected $collection = 'admin_products_colors';
    
    protected $fillable = [
        
    ];
}
