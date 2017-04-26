<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class DestinationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        $startDate = Carbon::create(2017, 6, 1, 0, 0, 0);
        $dates = [];

        for ( $i = 0; $i < 7; $i++) {

            array_push($dates, $startDate->addWeeks(rand(1, 52))->format('Y-m-d H:i:s'));

        }

        DB::table('destinations')->insert([
            'name' => $faker->city,
            'event_id' => 1,
            'date' => $dates[0]
        ]);

        DB::table('destinations')->insert([
            'name' => $faker->city,
            'event_id' => 2,
            'date' => $dates[1]
        ]);

        DB::table('destinations')->insert([
            'name' => $faker->city,
            'event_id' => 3,
            'date' => $dates[1]
        ]);


        foreach (range(4,20) as $index) {

            $event_id = $faker->numberBetween(4,7);

            DB::table('destinations')->insert([
                'name' => $faker->city,
                'event_id' => $event_id,
                'date' => $dates[$event_id - 1]
            ]);
        }

    }
}
