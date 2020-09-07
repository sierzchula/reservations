<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reservations;
use Faker\Generator as Faker;

$factory->define(Reservations::class, function (Faker $faker) {
    $startDay = strtotime(date('d-m-Y', time() ) . ( rand(0,1) ? " + " : " - "  ) . rand(1,14) . " days" );
    $days = rand(1,14);
    $endDay = strtotime("+" . $days . " day", $startDay);
    $priceDay = rand(50,250);
    $priceTotal = $priceDay * $days;
    
    if (rand(1,4) === 1) {
        $paid = 0;
        $status = 'Cancelled';
    } elseif (rand(1,4) === 1) {
        $paid = 0;
        $status = 'Not paid';
    } else {
        $paid = $endDay < time() ? $priceTotal : $priceTotal * 0.3;
        $status = $endDay < time() ? 'Fully paid' : 'Partially paid';
    }
    

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
