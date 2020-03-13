<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MainOrder;
use Faker\Generator as Faker;

$factory->define(MainOrder::class, function (Faker $faker) {
    return [
        'subiekt_number' => 'ZK '.$faker->numberBetween($min = 0, $max = 100).'/2020',
        'client' => $faker->lastName(),
        'status' => $faker->randomDigit(),
        'percent_done' => $faker->numberBetween($min = 0, $max = 99),
        'archive' => $faker->numberBetween($min = 0, $max = 1)
    ];
});
