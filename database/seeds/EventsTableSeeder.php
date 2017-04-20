<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Event::create([
            'name' => 'TTip Demo'
        ]);

        App\Event::create([
            'name' => 'Allgemeine Demo'
        ]);

        App\Event::create([
            'name' => 'Demo gegen Biofleisch'
        ]);
    }
}
