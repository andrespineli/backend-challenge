<?php

use Faker\Generator as Faker;
use App\Ecommerce\V1\Infrastructure\Models\Order;
use App\Ecommerce\V1\Infrastructure\Models\Customer;

$factory->define(Order::class, function (Faker $faker) {

    return [
        'customer_id' => Customer::orderByRaw('RAND()')->first()->id,
        'total' => 0,
        'status' => 'CONCLUDED'
    ];
});
