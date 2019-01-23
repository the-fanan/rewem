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

        Country::create([
            'name' => 'United States',
            'iso_code' => 'USA',
            'continent' => 'North America',
        ]);

        Country::create([
            'name' => 'London',
            'iso_code' => 'LN',
            'continent' => 'Europe',
        ]);
    }
}
