<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Faker\Provider\en_US\Company;
use Faker\Provider\en_US\PhoneNumber;

class TravelContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();

        foreach (range(1,2600) as $index) {

            DB::table('travel_contacts')->insert([
                'travel_id' => $index,
                'organisation' => $faker->company(),
                'name' => $faker->name(),
                'email' => $faker->safeEmail(),
                'phone_number' => $faker->e164PhoneNumber()
            ]);
        }
    }
}
