<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TravelOffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (range(1001,2000) as $index) {

            $faker = Faker::create();

            DB::table('travel_offers')->insert([
                'travel_id' => $index,
                'passenger' => $faker->numberBetween(1,8),
                'cost' => $faker->numberBetween(8,40)
            ]);

        }
    }
}
