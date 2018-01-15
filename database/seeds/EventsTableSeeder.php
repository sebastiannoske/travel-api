<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('events')->insert([
            'name' => 'Wir haben es satt!',
            'campaignText' => 'Die Folgende Mitfahrgelegenheit zur Demonstration am 7.9.2017 in Hamburg, wird organisiert vom Demobündnis „Wir haben es Satt“ und „Campact“.'
        ]);

        DB::table('events')->insert([
            'name' => 'Test Demo',
            'campaignText' => 'Omnicos directe al desirabilite de un nov lingua franca: On refusa continuar payar custosi traductores. At solmen va esser necessi far uniform grammatica, pronunciation e plu sommun paroles. Ma quande lingues coalesce, li grammatica del resultant lingue es plu simplic e regulari quam ti del coalescent lingues. Li nov lingua franca va esser plu simplic e regulari quam li existent Europan lingues. It va esser tam simplic quam Occidental in fact. Omnicos directe al desirabilite de un nov lingua franca: On refusa continuar payar custosi traductores. At solmen va esser necessi far uniform grammatica, pronunciation e plu sommun paroles.'
        ]);

        /* $faker = Faker::create();

        foreach (range(2,7) as $index) {
            DB::table('events')->insert([
                'name' => 'Demo  ' . $faker->word
            ]);
        } */

    }
}
