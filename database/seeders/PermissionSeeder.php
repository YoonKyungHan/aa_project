<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // 역할 생성
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $userRole = Role::create(['name' => 'user', 'guard_name' => 'web']);

        // 역할에 권한 할당
        $adminRole->givePermissionTo(Permission::all());
        $userRole->givePermissionTo(['edit articles', 'create articles', 'view articles']);

        // 사용자에 역할 할당 (예시로 ID가 1인 사용자를 가져옴)
        $user = \App\Models\User::find(2);
        if ($user) {
            $user->assignRole('admin');
        }
    }
}
