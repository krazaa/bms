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
        foreach (range(1,5000) as $index) {
            DB::table('categories')->insert([
                'category' => $faker->company(),
                //'vendor_id' => $faker->randomDigit(1,100),
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
