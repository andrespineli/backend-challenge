<?php

use Faker\Generator as Faker;
use Faker\Provider\pt_BR\Person;
use App\Ecommerce\V1\Infrastructure\Models\Customer;
use Illuminate\Support\Facades\Hash;

$factory->define(Customer::class, function (Faker $faker) {

    $faker->addProvider(new Person($faker));

    return [
        'name' => $faker->firstName(null),
        'cpf' => $faker->unique()->cpf(false),
        'email' => $faker->unique()->email() . $faker->unique()->numberBetween(0000, 9999),
        'password' => Hash::make('123456'),
        'api_token' => sha1(str_random(32)) . '.' . sha1(str_random(32))
    ];
});
