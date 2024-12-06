<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
class TranzactionHistory extends Eloquent
{
 use SoftDeletes;
    protected $connection = 'mongodb'; 
    protected $collection = 'tranzaction_history';
    
    protected $fillable = [
        // 'id', 'my_customer_auto_id', 'my_contact', 'transfer_contact', 'transfer_amount', 'credited_customer_auto_id'
    ];
}
