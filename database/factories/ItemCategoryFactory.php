<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\ItemCategory;
use Faker\Generator as Faker;

$factory->define(ItemCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement([
            'ROOM',
            'SURGERY',
            'PHARMACY',
            'THERAPY',
            'CENTRAL SUPPLY',
            'LABORATORY',
        ]),
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});
