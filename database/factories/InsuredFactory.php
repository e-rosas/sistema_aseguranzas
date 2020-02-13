<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Insured;
use Faker\Generator as Faker;

$factory->define(Insured::class, function (Faker $faker) {
    return [
        'person_data_id' => factory(App\PersonData::class)->create(['insured' => 1]),
        'insurance_id' => factory(App\Insurance::class),
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});
