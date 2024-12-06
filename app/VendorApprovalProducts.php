<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
class VendorApprovalProducts extends Eloquent
{
  use SoftDeletes;
    protected $connection = 'mongodb'; 
    protected $collection = 'Vendor_approval_products';
    
    protected $fillable = [
        
    ];
}
