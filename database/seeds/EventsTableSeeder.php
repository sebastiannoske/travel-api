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
            'name' => 'G20 Protestwelle'
        ]);
        /** $faker = Faker::create();

        foreach (range(1,7) as $index) {
            DB::table('events')->insert([
                'name' => 'Demo  ' . $faker->word
            ]);
        }

        */

    }
}
