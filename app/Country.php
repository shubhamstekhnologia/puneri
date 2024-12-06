<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
class Country extends Eloquent
{
 use SoftDeletes;
	protected $connection = 'mongodb'; 
    protected $collection = 'country';
    
    protected $fillable = [
       
    ];
}
