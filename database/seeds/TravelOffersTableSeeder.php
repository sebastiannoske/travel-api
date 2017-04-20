<?php

use Illuminate\Database\Seeder;
use App\TravelOffer;

class TravelOffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TravelOffer::create([
            'travel_id' => 2,
            'passenger' => 5,
            'cost' => 50.00
        ]);

        TravelOffer::create([
            'travel_id' => 3,
            'passenger' => 3,
            'cost' => 150.00
        ]);

        TravelOffer::create([
            'travel_id' => 5,
            'passenger' => 2,
            'cost' => 50.00
        ]);

        TravelOffer::create([
            'travel_id' => 6,
            'passenger' => 1,
            'cost' => 20.00
        ]);
    }
}
