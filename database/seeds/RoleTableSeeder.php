<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Role::create([
            'name' => 'superadmin',
            'fullname' => 'Super Administrator',
            'label' => 'A backend super administrator'
        ]);

        App\Role::create([
            'name' => 'admin',
            'fullname' => 'Administrator',
            'label' => 'A backend administrator'
        ]);

        App\Role::create([
            'name' => 'editor',
            'fullname' => 'Moderator',
            'label' => 'An editor can edit available travel'
        ]);

        App\Role::create([
            'name' => 'user',
            'fullname' => 'User',
            'label' => 'A user can edit his own travel only'
        ]);
    }
}
