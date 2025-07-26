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

$factory->define(App\Entities\TestData::class, function (Faker $faker) {
    return [
        'test_id' => $faker->numberBetween(1,10),
        'table_id' => 1,
        'column_name' => $faker->name,
        'value' => $faker->numberBetween(40,100),
    ];
});