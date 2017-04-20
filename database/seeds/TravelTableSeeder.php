<?php

use Illuminate\Database\Seeder;

class TravelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Travel::create([
            'description' => 'Schöne Fahrt von A nach B',
            'city' => 'Berlin',
            'postcode' => 12345,
            'street_address' => 'Teststraße 10',
            'user_id' => 1,
            'destination_id' => 1,
            'transportation_mean_id' => 1,
            'lat' => 52.5231013,
            'long' => 13.4822747
        ]);

        App\Travel::create([
            'description' => 'Schöne Fahrt von B nach C',
            'city' => 'Berlin',
            'postcode' => 12345,
            'street_address' => 'Teststraße 10',
            'user_id' => 1,
            'destination_id' => 1,
            'transportation_mean_id' => 3,
            'lat' => 52.5231013,
            'long' => 13.4822747
        ]);

        App\Travel::create([
            'description' => 'Schöne Fahrt von C nach D',
            'city' => 'Berlin',
            'postcode' => 12345,
            'street_address' => 'Teststraße 10',
            'user_id' => 1,
            'destination_id' => 2,
            'transportation_mean_id' => 2,
            'lat' => 52.5231013,
            'long' => 13.4822747
        ]);

        App\Travel::create([
            'description' => 'Schöne Fahrt von D nach E',
            'city' => 'Berlin',
            'postcode' => 12345,
            'street_address' => 'Teststraße 10',
            'user_id' => 1,
            'destination_id' => 3,
            'transportation_mean_id' => 1,
            'lat' => 52.5231013,
            'long' => 13.4822747
        ]);

        App\Travel::create([
            'description' => 'Schöne Fahrt von E nach F',
            'city' => 'Berlin',
            'postcode' => 12345,
            'street_address' => 'Teststraße 10',
            'user_id' => 2,
            'destination_id' => 4,
            'transportation_mean_id' => 1,
            'lat' => 52.5231013,
            'long' => 13.4822747
        ]);

        App\Travel::create([
            'description' => 'Schöne Fahrt von F nach G',
            'city' => 'Berlin',
            'postcode' => 12345,
            'street_address' => 'Teststraße 10',
            'user_id' => 2,
            'destination_id' => 5,
            'transportation_mean_id' => 3,
            'lat' => 52.5231013,
            'long' => 13.4822747
        ]);
    }

}
