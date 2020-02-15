<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Invoice;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'person_data_id' => $faker->numberBetween(1, 300),
        'number' => $faker->bankAccountNumber,
        'comments' => $faker->word(),
        'state' => 'owed',
        'date' => $faker->dateTimeThisDecade,
        'total' => $faker->numberBetween(5000, 14000),
        'total_with_discounts' => $faker->numberBetween(1000, 4500),
        'amount_paid' => $faker->numberBetween(10, 500),
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});
