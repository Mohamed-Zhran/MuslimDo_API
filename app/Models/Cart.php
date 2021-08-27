<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];
    protected $table = 'cart';

    public function product()
    {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }
}
