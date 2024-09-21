<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 권한 생성
        if (!Permission::where('name', 'edit articles')->exists()) {
            Permission::create(['name' => 'edit articles']);
        }

        if (!Permission::where('name', 'delete articles')->exists()) {
            Permission::create(['name' => 'delete articles']);
        }

        // 역할 생성 및 권한 부여
        if (!Role::where('name', 'user')->exists()) {
            $role = Role::create(['name' => 'user']);
            $role->givePermissionTo('edit articles');
        }

        if (!Role::where('name', 'admin')->exists()) {
            $role = Role::create(['name' => 'admin']);
            $role->givePermissionTo(['edit articles', 'delete articles']);
        }
    }
}
