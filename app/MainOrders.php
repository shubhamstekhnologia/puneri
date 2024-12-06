<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class MainOrders extends Eloquent
{
    protected $connection = 'mongodb'; 
    protected $collection = 'main_orders';
    
    protected $fillable = [
        
    ];
}
