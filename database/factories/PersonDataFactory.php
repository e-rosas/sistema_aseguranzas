<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\PersonData;
use Faker\Generator as Faker;

$factory->define(PersonData::class, function (Faker $faker) {
    return [
        'last_name' => $faker->lastName,
        'maiden_name' => $faker->lastName,
        'name' => $faker->firstName,
        'birth_date' => $faker->dateTimeThisCentury,
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'postal_code' => $faker->randomNumber(),
        'phone_number' => $faker->phoneNumber,
        'email' => $faker->email,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});
