<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'main_order_id' => factory('App\MainOrder')->create()->id,
        'accepted_date' => $faker->date(),
        'subiekt_number' => 'ZK '.$faker->numberBetween($min = 0, $max = 100).'/2020',
        'symbol' => $faker->word(),
        'product_id' => $faker->randomDigit(),
        'client' => $faker->lastName(),
        'quantity' => $faker->numberBetween($min = 0, $max = 100),
        'archive' => $faker->numberBetween($min = 0, $max = 1)
    ];
});
