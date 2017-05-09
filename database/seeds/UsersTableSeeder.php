<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        App\User::create([
            'name' => 'Basti',
            'email' => 'sebastian.noske@gmail.com',
            'password' => bcrypt('1suchasurge'),
            'verified' => true,
            'api_token' => str_random(60)
        ]);

        App\User::create([
            'name' => 'Stefan',
            'email' => 'stefan@bassliner.org',
            'password' => bcrypt('stefan123attravelapi'),
            'verified' => true,
            'api_token' => str_random(60)
        ]);

        App\User::create([
            'name' => 'Philipp',
            'email' => 'philipp@urban-digitals.com',
            'password' => bcrypt('philipp123attravelapi'),
            'verified' => true,
            'api_token' => str_random(60)
        ]);
    }
}
