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
        'id',
        'order_id',
        'product_id',
        'amount',
        'price_unit',
        'total'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'order_id',
        'product_id',
        'created_at',
        'updated_at'
    ];

    public function product()
    {
        return $this->hasOne('App\Ecommerce\V1\Infrastructure\Models\Product', 'id', 'product_id');
    }
}
