<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class DeliveryBoyCurrentLocation extends Eloquent
{
    protected $connection = 'mongodb'; 
    protected $collection = 'delivery_boy_current_locations';
    
    protected $fillable = [
        
    ];
}
