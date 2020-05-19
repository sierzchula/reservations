<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Apartaments;
use Faker\Generator as Faker;

$factory->define(Apartaments::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'persons' => rand(1,4)
    ];
});
