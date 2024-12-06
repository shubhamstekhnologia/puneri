<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Questions extends Eloquent
{
	protected $connection = 'mongodb'; 
    protected $collection = 'ecomm_boat_questions';
    
    protected $fillable = [
        
    ];
}
