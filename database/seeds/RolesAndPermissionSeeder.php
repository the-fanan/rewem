<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create Permissions
        Permission::create(['name' => 'create-country-admin','guard_name' => 'web']);
        Permission::create(['name' => 'create-gun-modulator','guard_name' => 'web']);
        Permission::create(['name' => 'create-gun','guard_name' => 'web']);
        Permission::create(['name' => 'assign-gun','guard_name' => 'web']);
        Permission::create(['name' => 'control-gun','guard_name' => 'web']);

        //Create Roles
        $SuperAdmin = Role::create(['name' => 'super-admin','guard_name' => 'web']);
        $CountryAdmin = Role::create(['name' => 'country-admin','guard_name' => 'web']);
        $GunCreator = Role::create(['name' => 'gun-creator','guard_name' => 'web']);
        $GunAssigner = Role::create(['name' => 'gun-assigner','guard_name' => 'web']);
        $GunController = Role::create(['name' => 'gun-controller','guard_name' => 'web']);
        
        //assign permission to roles
        $SuperAdmin->givePermissionTo('create-country-admin');
        $CountryAdmin->givePermissionTo('create-gun-modulator');
        $GunCreator->givePermissionTo('create-gun');
        $GunAssigner->givePermissionTo('assign-gun');
        $GunController->givePermissionTo('control-gun');
    }
}
