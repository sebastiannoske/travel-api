<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TravelRequestsTableSeeder extends Seeder
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

            DB::table('travel_requests')->insert([
                'travel_id' => $index,
                'passenger' => $faker->numberBetween(1,8),
                'cost' => $faker->numberBetween(8,40)
            ]);

        }

    }
}
