<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
class admin_login extends Eloquent
{ 
  use SoftDeletes;
	protected $connection = 'mongodb'; 
    protected $collection = 'admin_login';
    
    protected $fillable = [
        
    ];
}
// db.admin_login.insert({admin_id:"5f2fcf6eb1938970a479bb92", name:"Anmol Bazar", username: "AnMoLbaZaR3470", email: "anmolbazar29@gmail.com", contact: "9302750860", password: "$2y$10$ap2snRXTZW.aeK6gXR.tYuhUcQaOA3vixXmB1d/v6UhIxIfIipUji"})

// pwd = Xyz12345