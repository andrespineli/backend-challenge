<?php

use Faker\Generator as Faker;
use App\Models\Order;
use App\Models\Customer;

$factory->define(Order::class, function (Faker $faker) {

    return [
        'customer_id' => Customer::orderByRaw('RAND()')->first()->id,
        'total' => 0,
        'status' => 'CONCLUDED'
    ];
});
