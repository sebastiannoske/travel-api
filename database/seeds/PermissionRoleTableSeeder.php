<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Super Admin

        DB::table('permission_role')->insert([
            ['permission_id' => 1, 'role_id' => 1],
            ['permission_id' => 2, 'role_id' => 1],
            ['permission_id' => 3, 'role_id' => 1],
            ['permission_id' => 4, 'role_id' => 1]
        ]);

        // Admin

        DB::table('permission_role')->insert([
            ['permission_id' => 2, 'role_id' => 2],
            ['permission_id' => 3, 'role_id' => 2],
            ['permission_id' => 4, 'role_id' => 2]
        ]);

        // Editor

        DB::table('permission_role')->insert([
            ['permission_id' => 3, 'role_id' => 3],
            ['permission_id' => 4, 'role_id' => 3]
        ]);

        // User

        DB::table('permission_role')->insert([
            ['permission_id' => 4, 'role_id' => 4]
        ]);

    }
}
