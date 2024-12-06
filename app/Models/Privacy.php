<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Privacy extends Eloquent
{
    protected $connection = 'mongodb'; 
    protected $collection = 'privacy';
    
    protected $fillable = [
        'id', 'privacy'
    ];
}
