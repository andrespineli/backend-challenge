<?php

use Faker\Generator as Faker;
use App\Ecommerce\V1\Infrastructure\Models\Order;
use App\Ecommerce\V1\Infrastructure\Models\Customer;

$factory->define(Order::class, function (Faker $faker) {   

    factory(Customer::class, 5)->create();
    
    return [
        'customer_id' => Customer::find(rand(1, 5))->id,
        'total' => 0,
        'status' => 'CONCLUDED'
    ];
});
