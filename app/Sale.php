<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //

    public function transaction(){
    	return $this->belongsTo('App\Transaction');
    }
}
