<?php

use Faker\Generator as Faker;
use Faker\Provider\Lorem;
use App\Models\Product;

$factory->define(Product::class, function (Faker $faker) {

    $faker->addProvider(new Lorem($faker));
   
    return [     
        'sku' => $faker->randomNumber(5),
        'name' => $faker->word,
        'price' => $faker->randomFloat(2, 100, 1000)
    ];

});

