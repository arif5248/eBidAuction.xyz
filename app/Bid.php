<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    public function buyer(){
        return $this->hasOne(User::class, 'id', 'buyer_id');
    }

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
