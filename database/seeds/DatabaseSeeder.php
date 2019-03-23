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
            DB::table('excises')->insert([
                'office' => $faker->name(),
                'model' => $faker->firstNameMale(),
                'cost' => $faker->randomNumber(),
                'selling' => $faker->randomNumber(),
                'agent_id' => $faker->randomNumber(),
                // 'phone' => $faker->phoneNumber(),
                // 'address' => $faker->address(),
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
