<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Insurer;
use Faker\Generator as Faker;

$factory->define(Insurer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'postal_code' => $faker->postcode,
        'phone_number' => $faker->phoneNumber,
        'email' => $faker->email,
        'code' => $faker->slug,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});
