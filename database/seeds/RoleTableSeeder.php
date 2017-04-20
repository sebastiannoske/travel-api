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
            'name' => 'admin',
            'label' => 'A backend administrator'
        ]);

        App\Role::create([
            'name' => 'editor',
            'label' => 'An editor can edit available travel'
        ]);

        App\Role::create([
            'name' => 'user',
            'label' => 'A user can edit his own travel only'
        ]);
    }
}
