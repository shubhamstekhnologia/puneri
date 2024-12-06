<?php
namespace App;



use Illuminate\Database\Eloquent\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


use Illuminate\Database\Eloquent\SoftDeletes;
class AppUIStyle extends Eloquent

{
 use SoftDeletes;
    protected $connection = 'mongodb'; 

    protected $collection = 'app_ui_style';

    

    protected $fillable = [

      

    ];

}

