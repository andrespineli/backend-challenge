<?php

namespace App\Ecommerce\V1\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'amount',
        'price_unit',
        'total'
    ];
    
}

