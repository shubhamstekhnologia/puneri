<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
class VerifyUserRegister extends Eloquent
{
use SoftDeletes;
    protected $connection = 'mongodb'; 
    protected $collection = 'verify_users_contact';
    
    protected $fillable = [
        // 'id', 'doctor_id', 'name','email', 'contact', 'country_code', 'doctor_name','status', 'clinic_name', 'password','token','otp','otp_status'
    ];
}
