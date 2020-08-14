<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reservations;
use Faker\Generator as Faker;

$factory->define(Reservations::class, function (Faker $faker) {
    $startDay = strtotime("+" . rand(1,28) - 14 . " day", time());
    $days = rand(1,14);
    $endDay = strtotime("+" . $days . " day", time());
    $priceDay = rand(50,250);
    $priceTotal = $priceDay * $days;
    $paid = $endDay < time() ? $priceTotal : $priceTotal * 0.3;
    $status = $endDay < time() ? 'Fully paid' : 'Partially paid';

    return [
        'apartments_id' => function () {
            return factory(App\Apartments::class)->create()->id;
        },
        'clients_id' => function () {
            return factory(App\Clients::class)->create()->id;
        },
        'start_date' => $startDay,
        'end_date' => $endDay,
        'price_day' => $priceDay,
        'money_total' => $priceTotal,
        'money_paid' => $paid,
        'status' => $status,
        'adults' => rand (1,2),
        'kids' => rand (0,2),
        'notes' => $faker->paragraph()

    ];
});
