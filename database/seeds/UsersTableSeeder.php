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
            'name' => 'Kat',
            'email' => 's.noske@gmx.net',
            'password' => bcrypt('1suchasurge'),
            'verified' => true,
            'api_token' => str_random(60)
        ]);
    }
}
