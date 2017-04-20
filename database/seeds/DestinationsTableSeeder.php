<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DestinationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Destination::create([
            'name' => 'München',
            'event_id' => 1,
            'date' => Carbon::createFromDate(2017, 8, 21, 'GMT')
        ]);

        App\Destination::create([
            'name' => 'Hamburg',
            'event_id' => 1,
            'date' => Carbon::createFromDate(2017, 8, 21, 'GMT')
        ]);

        App\Destination::create([
            'name' => 'Köln',
            'event_id' => 1,
            'date' => Carbon::createFromDate(2017, 8, 21, 'GMT')
        ]);

        App\Destination::create([
            'name' => 'Berlin',
            'event_id' => 2,
            'date' => Carbon::createFromDate(2017, 9, 5, 'GMT')
        ]);

        App\Destination::create([
            'name' => 'Berlin',
            'event_id' => 3,
            'date' => Carbon::createFromDate(2017, 10, 10, 'GMT')
        ]);
    }
}
