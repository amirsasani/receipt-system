<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [];

    public function orderAmount()
    {
        $amount = 0;
        $productTypes = $this->productTypes;
        foreach ($productTypes as $pt) {
            $amount += $pt->pivot->amount;
        }
        return $amount;
    }

    public function orderTotalPrice()
    {
        $price = 0;
        $productTypes = $this->productTypes;
        foreach ($productTypes as $pt) {
            $price += $pt->price * $pt->pivot->amount;
        }
        return $price;
    }

    public function productTypes()
    {
        return $this->belongsToMany('App\ProductType')->withPivot('amount')->withTimestamps();
    }
}
