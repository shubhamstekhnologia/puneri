<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class DeliveryBoy extends Eloquent
{
    protected $connection = 'mongodb'; 
    protected $collection = 'delivery_boy';
    
    protected $fillable = [
        
    ];
}