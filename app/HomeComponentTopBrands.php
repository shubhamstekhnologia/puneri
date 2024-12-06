<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
class HomeComponentTopBrands extends Eloquent
{
 use SoftDeletes;
	protected $connection = 'mongodb'; 
    protected $collection = 'HomeComponentTopBrands';
    
    protected $fillable = [
        
    ];
}
