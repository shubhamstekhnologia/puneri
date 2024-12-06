<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
class Search extends Eloquent
{
   use SoftDeletes;
    protected $connection = 'mongodb'; 
    protected $collection = 'search_list';
    
    protected $fillable = [
        
    ];
}
