<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderPosition;
use Faker\Generator as Faker;

$factory->define(OrderPosition::class, function (Faker $faker) {
    return [
        'order_id' => $faker->numberBetween($min = 0, $max = 10),
        'worker' => $faker->randomDigit(),
        'status' => $faker->randomDigit(),
        'quantity' => $faker->randomDigit(),
    ];
});
