<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;

class UserDocument extends Eloquent
{
    use SoftDeletes;
	protected $connection = 'mongodb';
    protected $collection = 'UserDocument';

    protected $fillable = [
    //   'id','trainer_id','name','trainer_name','email','mobile_number','password','token','status'
    ];
}
