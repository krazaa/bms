<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //$this->call(UsersTableSeeder::class);
        //$this->call(LaratrustSeeder::class);


        $faker = Faker::create();
        foreach (range(1,100) as $index) {
            DB::table('agents')->insert([
                'company' => $faker->company(),
                'person' => $faker->firstNameMale(),
                'person2' => $faker->lastName(),
                'mobile' => $faker->randomNumber(),
                'tel' => $faker->randomNumber(),
                'tel2' => $faker->randomNumber(),
                'email' => $faker->email(),
                'address' => $faker->address(),
                // 'cat_id' => $faker->randomDigit(1,9),
                // 'name' => $faker->company(),
                // 'code' => Str::random(10),
                // 'comppartno' => Str::random(10),
                // 'cost' => $faker->randomDigit(),
                // 'qty' => $faker->randomDigit(),
                // 'shortname' => $faker->countryCode(),
                
                
            ]);
        }
    }
}
