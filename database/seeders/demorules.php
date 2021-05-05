<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class demorules extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'all']);
        $role->givePermissionTo($permission);
        $role = Role::create(['name' => 'operation']);
        $permission = Permission::create(['name' => 'show Truck']);
        $role->givePermissionTo($permission);


    }
}
