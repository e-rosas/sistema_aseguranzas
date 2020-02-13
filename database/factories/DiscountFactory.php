<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Discount;
use Faker\Generator as Faker;

$factory->define(Discount::class, function (Faker $faker) {
    return [
        'percentage_increase' => $faker->numberBetween(0, 50),
        'range_of_days' => '0-30', //edit
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});
