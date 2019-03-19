<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\modules\Vendor;
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

$factory->define(Vendor::class, function (Faker $faker) {
    return [
        		//'vnum' => $faker->vnum,
                'company' => $faker->name,
                'person' => $faker->name,
                'contact' => $faker->number,
                'mobile' => $faker->number,
                'bmobile' => $faker->number,
                'address' => $faker->number,
                'email' => $faker->email,
                'website' => $faker->number,
                'ntn' => $faker->number,
                'salestax' => $faker->number,
                
        
    ];
});
