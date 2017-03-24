<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Gloudemans\Shoppingcart\Contracts\Buyable;

class Product extends Model implements Buyable
{
    //

    protected $fillable = ['name', 'brand', 'category' , 'description', 'price', 'total'];

    public function getBuyableIdentifier($options = null){
        return $this->id;
    }

    public function getBuyableDescription($options = null){
        return $this->name;
    }

    public function getBuyablePrice($options = null){
        return $this->price;
    }
}
