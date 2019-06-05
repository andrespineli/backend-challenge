<?php

use Faker\Generator as Faker;
use Faker\Provider\pt_BR\Person;
use App\Models\Customer;

$factory->define(Customer::class, function (Faker $faker) {

    $faker->addProvider(new Person($faker));
   
    return [     
        'name' => $faker->firstName(null),
        'cpf' => $faker->cpf(false),
        'email' => $faker->email(),
        'password' => '123456'
    ];
});
