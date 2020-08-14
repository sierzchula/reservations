<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Clients;
use Faker\Generator as Faker;

$factory->define(Clients::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'phone' => $faker->PhoneNumber,
        'email' => $faker->unique()->safeEmail
    ];
});
