<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(EmailTemplateSeeder::class);
        $this->call(DestinationsTableSeeder::class);
        $this->call(TransportationMeansTableSeeder::class);

        /*$this->call(TravelTableSeeder::class);
        $this->call(TravelRequestsTableSeeder::class);
        $this->call(TravelOffersTableSeeder::class);
        $this->call(StopoverTableSeeder::class);
        $this->call(TravelContactsTableSeeder::class);*/

    }
}
