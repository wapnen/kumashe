<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //

    public function sale(){
    	return $this->hasMany('App\Sale');
    }
}
