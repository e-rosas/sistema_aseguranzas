<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'code' => $faker->randomNumber(7),
        'description' => $faker->randomElement([
            'URINALYSIS',
            'CONSULTING',
            'PELVIS ULTRASOUND',
            'ABDOMINAL ULTRASOUND',
            'ELECTROLYTE PANEL',
            'CBC',
        ]),
        'price' => $faker->numberBetween(200, 900),
        'discounted_price' => $faker->numberBetween(10, 100),
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});
