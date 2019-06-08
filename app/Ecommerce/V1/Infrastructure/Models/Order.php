<?php

namespace App\Ecommerce\V1\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'customer_id',
        'total',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'customer_id'
    ];

    public function items()
    {
        return $this->hasMany('App\Ecommerce\V1\Infrastructure\Models\OrderItem', 'order_id');
    }

    public function buyer()
    {
        return $this->belongsTo('App\Ecommerce\V1\Infrastructure\Models\Customer', 'customer_id');
    }
    
}

