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

        $user2 = User::create([
            'fullname' => 'Ben Mike',
            'email' => 'ben123@yahoo.com',
            'password' => bcrypt('ben123'),
            'group_id' => 1,
            'status' => 'active'
        ]);

        $user2->assignRole('group-admin');

        $user3 = User::create([
            'fullname' => 'Suli Yat',
            'email' => 'suli123@yahoo.com',
            'password' => bcrypt('suli123'),
            'group_id' => 1,
            'status' => 'active'
        ]);

        $user3->assignRole('gun-creator');

        $user4 = User::create([
            'fullname' => 'John Doe',
            'email' => 'john123@yahoo.com',
            'password' => bcrypt('john123'),
            'group_id' => 1,
            'status' => 'active'
        ]);

        $user4->assignRole('gun-assigner');

        $user5 = User::create([
            'fullname' => 'Janet Doe',
            'email' => 'janet123@yahoo.com',
            'password' => bcrypt('janet123'),
            'group_id' => 1,
            'status' => 'active'
        ]);

        $user5->assignRole('gun-controller');



    }
}
