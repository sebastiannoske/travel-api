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
            'password' => bcrypt(env('APP_USERPASSWORD', str_random(10))),
            'verified' => true,
            'api_token' => env('APP_APITOKEN', str_random(60))
        ]);

        App\User::create([
            'name' => 'Stefan',
            'email' => 'stefan@bassliner.org',
            'password' => bcrypt(env('APP_USERPASSWORD2', str_random(10))),
            'verified' => true,
            'api_token' => null
        ]);

        App\User::create([
            'name' => 'User',
            'email' => 'rollmann@meine-landwirtschaft.de',
            'password' => bcrypt(env('APP_USERPASSWORD2', str_random(10))),
            'verified' => true,
            'api_token' => null
        ]);
    }
}