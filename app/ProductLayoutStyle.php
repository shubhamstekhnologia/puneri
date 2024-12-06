<?php
namespace App;



use Illuminate\Database\Eloquent\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;

class ProductLayoutStyle extends Eloquent

{
  use SoftDeletes;
    protected $connection = 'mongodb'; 

    protected $collection = 'product_layout_style';

    

    protected $fillable = [

      

    ];

}

