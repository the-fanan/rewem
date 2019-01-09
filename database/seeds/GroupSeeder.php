<?php

use Illuminate\Database\Seeder;
use rewem\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create([
            'name' => 'Nigeria',
            'type' => 'country',
            'country_id' => 1
        ]);
    }
}
