<?php

use Illuminate\Database\Seeder;
use rewem\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'fullname' => 'Fanan Dala',
            'email' => 'fanan.dala@yahoo.com',
            'password' => bcrypt('fanan123'),
            'status' => 'active'
        ]);

        $user1->assignRole('super-admin');
    }
}
