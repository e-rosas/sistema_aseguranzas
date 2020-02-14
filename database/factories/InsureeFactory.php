<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Insuree;
use Faker\Generator as Faker;

$factory->define(Insuree::class, function (Faker $faker) {
    return [
        'person_data_id' => factory(App\PersonData::class)->create(['insured' => 1]),
        'insurer_id' => factory(App\Insurer::class),
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});
