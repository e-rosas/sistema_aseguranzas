<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'code' => $faker->randomNumber(7),
        'description' => $faker->randomElement([
            'ADHESIVE TAPE',
            'ALCOHOL',
            'CAP',
            'CATHETER JJ',
            'AFRIN',
            'AVELOX',
            'DEXTREVIT',
            'GROTEN',
            'LEFEBRE',
            'ELECTRODES',
        ]),
        'type' => $faker->randomElement([
            'MATERIAL',
            'PHARMACY',
        ]),
        'SAT' => $faker->randomNumber(7),
        'tax' => $faker->boolean(),
        'price' => $faker->numberBetween(30, 200),
        'discounted_price' => $faker->numberBetween(1, 29),
        'item_category_id' => $faker->numberBetween(1, 5),
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});
