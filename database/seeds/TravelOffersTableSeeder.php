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

        $faker = Faker::create();

        foreach (range(1,1000) as $index) {


            DB::table('travel_offers')->insert([
                'travel_id' => $index,
                'passenger' => $faker->numberBetween(1,8),
                'cost' => $faker->numberBetween(8,40)
            ]);

        }

        foreach (range(1501,1850) as $index) {

            DB::table('travel_offers')->insert([
                'travel_id' => $index,
                'passenger' => $faker->numberBetween(1,8),
                'cost' => $faker->numberBetween(8,40)
            ]);

        }

        foreach (range(2001,2130) as $index) {

            DB::table('travel_offers')->insert([
                'travel_id' => $index,
                'passenger' => $faker->numberBetween(1,8),
                'cost' => $faker->numberBetween(8,40)
            ]);

        }

        foreach (range(2201,2450) as $index) {

            DB::table('travel_offers')->insert([
                'travel_id' => $index,
                'passenger' => $faker->numberBetween(1,8),
                'cost' => $faker->numberBetween(8,40)
            ]);

        }
    }
}
