<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductRatingReview extends Eloquent
{
  use SoftDeletes;
    protected $connection = 'mongodb'; 
    protected $collection = 'product_rating_reviews';
    
    protected $fillable = [
      
    ];
}
