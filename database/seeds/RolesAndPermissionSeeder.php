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
        Permission::create(['name' => 'create-group','guard_name' => 'web']);
        Permission::create(['name' => 'create-group-admin','guard_name' => 'web']);
        Permission::create(['name' => 'manage-group-admin','guard_name' => 'web']);
        Permission::create(['name' => 'create-gun-modulator','guard_name' => 'web']);
        Permission::create(['name' => 'create-gun','guard_name' => 'web']);
        Permission::create(['name' => 'assign-gun','guard_name' => 'web']);
        Permission::create(['name' => 'control-gun','guard_name' => 'web']);
        Permission::create(['name' => 'view-gun-parameters','guard_name' => 'web']);

        //Create Roles
        $SuperAdmin = Role::create(['name' => 'super-admin','guard_name' => 'web']);
        $GroupAdmin = Role::create(['name' => 'group-admin','guard_name' => 'web']);
        $GunCreator = Role::create(['name' => 'gun-creator','guard_name' => 'web']);
        $GunAssigner = Role::create(['name' => 'gun-assigner','guard_name' => 'web']);
        $GunController = Role::create(['name' => 'gun-controller','guard_name' => 'web']);
        $GunUser = Role::create(['name' => 'gun-user','guard_name' => 'web']);
        
        //assign permission to roles
        //super admin
        $SuperAdmin->givePermissionTo('create-group');
        $SuperAdmin->givePermissionTo('create-group-admin');
        //group admin
        $GroupAdmin->givePermissionTo('create-gun-modulator');
        $GroupAdmin->givePermissionTo('create-group-admin');
        $GroupAdmin->givePermissionTo('manage-group-admin');
        $GroupAdmin->givePermissionTo('view-gun-parameters');
        $GroupAdmin->givePermissionTo('create-gun');
        $GroupAdmin->givePermissionTo('control-gun');
        //others
        $GunCreator->givePermissionTo('create-gun');
        $GunController->givePermissionTo('control-gun');
        $GunController->givePermissionTo('assign-gun');
        $GunController->givePermissionTo('view-gun-parameters');
        //gun user
        $GunUser->givePermissionTo('view-gun-parameters');
    }
}
