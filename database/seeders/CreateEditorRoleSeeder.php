<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateEditorRoleSeeder extends Seeder
{
    public function run()
    {
        // 'editor' 역할 생성
        $role = Role::create(['name' => 'editor']);

        // 에디터에게 필요한 권한 생성
        $permissions = [
            'view posts',
            'create posts',
            'edit posts',
            'delete posts',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // 에디터 역할에 권한 부여
        $role->givePermissionTo($permissions);

        $this->command->info('Editor role created successfully.');
    }
}