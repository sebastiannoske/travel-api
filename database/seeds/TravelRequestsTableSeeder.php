<?php

use Illuminate\Database\Seeder;
use App\TravelRequest;

class TravelRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TravelRequest::create([
            'travel_id' => 1,
            'passenger' => 2,
            'cost' => 70.00
        ]);

        TravelRequest::create([
            'travel_id' => 4,
            'passenger' => 25,
            'cost' => 10.00
        ]);
    }
}
