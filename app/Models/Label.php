<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Label extends Eloquent
{
    protected $connection = 'mongodb'; 
    protected $collection = 'labels';
    
    protected $fillable = [
       
    ];
}