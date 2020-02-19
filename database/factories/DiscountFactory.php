<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Discount;
use Faker\Generator as Faker;

$factory->define(Discount::class, function (Faker $faker) {
    return [
        'percentage' => $faker->numberBetween(0, 50),
        'range_of_days' => $faker->randomElement([
            '0 - 30',
            '31 - 90',
            '91 - 180',
        ]),
        'amount_of_days' => $faker->randomElement([
            30,
            60,
            90,
        ]),
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});
