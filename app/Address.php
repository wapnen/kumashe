<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //

    protected $fillable =  ['address', 'landmark', 'LGA'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
