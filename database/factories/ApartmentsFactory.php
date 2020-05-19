<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Apartments;
use Faker\Generator as Faker;

$factory->define(Apartments::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'persons' => rand(1,4)
    ];
});
