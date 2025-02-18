<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
