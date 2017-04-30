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

        $means = [];

        for ( $i = 0; $i < 100; $i++) {

            if ($i < 25) {

                array_push($means, 1);

            } else if ($i < 50) {

                array_push($means, 1);

            } else if ($i < 75) {

                array_push($means, 3);

            } else {

                array_push($means, $faker->numberBetween(4,7));

            }

        }

        shuffle($means);

        foreach (range(1,1500) as $index) {

            DB::table('travels')->insert([
                'verified' => true,
                'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'city' => $faker->city,
                'postcode' => $faker->postcode,
                'street_address' => $faker->streetAddress,
                'user_id' => $faker->numberBetween(1,2),
                'destination_id' => 1,
                'verified' => true,
                'public' => true,
                'transportation_mean_id' => $means[$faker->numberBetween(0,99)],
                'lat' => $faker->latitude($min = 48, $max = 54),
                'long' => $faker->longitude($min = 7, $max = 13),
                'created_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
        }

        foreach (range(1501,2000) as $index) {

            DB::table('travels')->insert([
                'verified' => true,
                'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'city' => $faker->city,
                'postcode' => $faker->postcode,
                'street_address' => $faker->streetAddress,
                'user_id' => $faker->numberBetween(1,2),
                'destination_id' => 2,
                'verified' => true,
                'public' => true,
                'transportation_mean_id' => $means[$faker->numberBetween(0,99)],
                'lat' => $faker->latitude($min = 48, $max = 54),
                'long' => $faker->longitude($min = 7, $max = 13),
                'created_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
        }

        foreach (range(2001,2200) as $index) {

            DB::table('travels')->insert([
                'verified' => true,
                'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'city' => $faker->city,
                'postcode' => $faker->postcode,
                'street_address' => $faker->streetAddress,
                'user_id' => $faker->numberBetween(1,2),
                'destination_id' => 3,
                'verified' => true,
                'public' => true,
                'transportation_mean_id' => $means[$faker->numberBetween(0,99)],
                'lat' => $faker->latitude($min = 48, $max = 54),
                'long' => $faker->longitude($min = 7, $max = 13),
                'created_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
        }

        foreach (range(2201,2600) as $index) {

            DB::table('travels')->insert([
                'verified' => true,
                'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'city' => $faker->city,
                'postcode' => $faker->postcode,
                'street_address' => $faker->streetAddress,
                'user_id' => $faker->numberBetween(1,2),
                'destination_id' => $faker->numberBetween(4,20),
                'verified' => true,
                'public' => true,
                'transportation_mean_id' => $means[$faker->numberBetween(0,99)],
                'lat' => $faker->latitude($min = 48, $max = 54),
                'long' => $faker->longitude($min = 7, $max = 13),
                'created_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
        }


    }

}
