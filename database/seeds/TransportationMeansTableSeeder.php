<?php

use Illuminate\Database\Seeder;

class TransportationMeansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\TransportationMean::create([
            'name' => 'Auto'
        ]);

        App\TransportationMean::create([
            'name' => 'Bus'
        ]);

        App\TransportationMean::create([
            'name' => 'Zug'
        ]);

        App\TransportationMean::create([
            'name' => 'Bassliner'
        ]);

        App\TransportationMean::create([
            'name' => 'Fahrrad'
        ]);

        App\TransportationMean::create([
            'name' => 'Fußgänger'
        ]);

        App\TransportationMean::create([
            'name' => 'Sonstige'
        ]);
    }
}
