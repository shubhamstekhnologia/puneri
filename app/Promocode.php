<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
class Promocode extends Eloquent

{
 use SoftDeletes;
    protected $connection = 'mongodb'; 

    protected $collection = 'promocode';

    

    protected $fillable = [

        

        // 'id','vendor_auto_id','to_customers','from_customers','code','discount','money_up_to','description'

    ];

}

