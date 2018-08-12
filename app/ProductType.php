<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    public $table = "product_types";

    protected $fillable = ['product_id', 'name', 'price', 'description'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }
}
