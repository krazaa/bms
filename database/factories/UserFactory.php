<?php

use App\User;
use Illuminate\Support\Str;
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

$factory->define(Autoproduct::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'code' => $faker->code,
        'vendor_id' => $faker->vendor_id(),
        'shortname' => $faker->shortname,
        
    ];
});
