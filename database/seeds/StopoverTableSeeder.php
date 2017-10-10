<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class StopoverTableSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
        $travel = DB::table('travels')->where('travels.transportation_mean_id', '=', '2')->select('travels.id')->get();
        $travel_ids = $travel->toArray();
        $maxIndex = count($travel_ids) - 1;

        foreach (range(1,200) as $index) {

            DB::table('stopovers')->insert([
                'travel_id' => $travel_ids[$faker->numberBetween(1, $maxIndex)]->id,
                'city' => $faker->city,
                'postcode' => $faker->postcode,
                'street_address' => $faker->streetAddress,
                'lat' => $faker->latitude($min = 48, $max = 54),
                'long' => $faker->longitude($min = 7, $max = 13),
                'created_at' => Carbon::now()
            ]);
        }
    }
}
