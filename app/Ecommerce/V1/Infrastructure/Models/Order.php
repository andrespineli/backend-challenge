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
        'customer_id',
        'total',
        'status'
    ];
    
}

