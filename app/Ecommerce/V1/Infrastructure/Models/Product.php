<?php

namespace App\Ecommerce\V1\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'sku',
        'name',
        'price'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    
}

