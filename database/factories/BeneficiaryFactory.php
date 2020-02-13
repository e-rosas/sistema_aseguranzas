<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Beneficiary;
use Faker\Generator as Faker;

$factory->define(Beneficiary::class, function (Faker $faker) {
    return [
        'person_data_id' => factory(App\PersonData::class)->create(['insured' => 0]),
        'insured_id' => factory(App\Insured::class),
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});
