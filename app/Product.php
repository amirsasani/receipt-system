<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name'];

    public function productTypes()
    {
        return $this->hasMany('App\ProductType');
    }
}
