<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Permission::create([
            'name' => 'edit_all',
            'label' => 'Edit everything'
        ]);

        App\Permission::create([
            'name' => 'edit_travel',
            'label' => 'Edit every travel'
        ]);

        App\Permission::create([
            'name' => 'edit_own',
            'label' => 'Edit own travel'
        ]);
    }
}
