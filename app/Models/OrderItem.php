<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'variation_id',
        'order_id',
        'price',
        'quantity',
        'total_price',
    ];
}
