<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Entities\Test::class, function (Faker $faker) {
    return [
        'name' => 'Test name here',
        'hr_peak' => $faker->numberBetween(40,100),
        'bp' => $faker->numberBetween(40,100),
        'hr_rest' => $faker->numberBetween(40,100),
        'weight' => $faker->numberBetween(40,100),
        'test_type' => 1,
    ];
});