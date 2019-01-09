<?php

use Illuminate\Database\Seeder;
use rewem\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'name' => 'Nigeria',
            'iso_code' => 'NG',
            'continent' => 'Africa',
        ]);
    }
}
