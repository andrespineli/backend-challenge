<?php

use Faker\Generator as Faker;
use Faker\Provider\Lorem;
use App\Ecommerce\V1\Infrastructure\Models\Product;

$factory->define(Product::class, function (Faker $faker) {

    $faker->addProvider(new Lorem($faker));

    return [
        'sku' => $faker->unique()->numberBetween(0000000000000000, 9999999999999999),
        'name' => $faker->unique()->word() . $faker->unique()->numberBetween(0000, 9999),
        'price' => $faker->randomFloat(2, 100, 1000)
    ];
});
