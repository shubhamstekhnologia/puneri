<?php
namespace App;



use Illuminate\Database\Eloquent\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessDetails extends Eloquent

{
  use SoftDeletes;
    protected $connection = 'mongodb'; 

    protected $collection = 'busniess_details';

    

    protected $fillable = [

      

    ];

}

