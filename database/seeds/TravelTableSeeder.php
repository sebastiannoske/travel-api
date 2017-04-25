<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TravelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1,2000) as $index) {

            DB::table('travels')->insert([
                'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'city' => $faker->city,
                'postcode' => $faker->postcode,
                'street_address' => $faker->streetAddress,
                'user_id' => $faker->numberBetween(1,2),
                'destination_id' => $faker->numberBetween(1,50),
                'transportation_mean_id' => $faker->numberBetween(1,7),
                'lat' => $faker->latitude($min = 48, $max = 54),
                'long' => $faker->longitude($min = 7, $max = 13)
            ]);
        }

    }

}
