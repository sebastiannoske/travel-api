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
        DB::table('destinations')->insert([
            'name' => 'Brandenburger Tor',
            'lat' => 52.516200,
            'long' => 13.377028,
            'event_id' => 1,
            'pin_color' => 'blue',
            'date' => Carbon::create(2022, 1, 22, 12, 0, 0)
        ]);

        /*DB::table('destinations')->insert([
            'name' => 'Frankfurt',
            'lat' => 50.1150384,
            'long' => 8.6701293,
            'event_id' => 1,
            'pin_color' => 'darkred',
            'date' => Carbon::create(2019, 5, 19, 12, 0, 0)
        ]);

        DB::table('destinations')->insert([
            'name' => 'Hamburg',
            'lat' => 53.5508717,
            'long' => 9.9917392,
            'event_id' => 1,
            'pin_color' => 'violet',
            'date' => Carbon::create(2019, 5, 19, 12, 0, 0)
        ]);

        DB::table('destinations')->insert([
            'name' => 'Köln',
            'lat' => 50.9338788,
            'long' => 6.9677085,
            'event_id' => 1,
            'pin_color' => 'blue',
            'date' => Carbon::create(2019, 5, 19, 12, 0, 0)
        ]);

        DB::table('destinations')->insert([
            'name' => 'Leipzig',
            'lat' => 51.3351466,
            'long' => 12.3727957,
            'event_id' => 1,
            'pin_color' => 'cyan',
            'date' => Carbon::create(2019, 5, 19, 12, 0, 0)
        ]);

        DB::table('destinations')->insert([
            'name' => 'München',
            'lat' => 48.1433895,
            'long' => 11.5753355,
            'event_id' => 1,
            'pin_color' => 'green',
            'date' => Carbon::create(2019, 5, 19, 12, 0, 0)
        ]);

        DB::table('destinations')->insert([
            'name' => 'Stuttgart',
            'lat' => 48.7830007,
            'long' => 9.179412,
            'event_id' => 1,
            'pin_color' => 'darkgreen',
            'date' => Carbon::create(2019, 5, 19, 12, 0, 0)
        ]);*/

        /* $faker = Faker::create();
        $startDate = Carbon::create(2019, 4, 1, 0, 0, 0);
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
        } */


    }
}
