<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class AssignRolesToUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 사용자 ID가 1인 사용자 가져오기
        $user = User::find(1);

        if ($user) {
            // 모든 역할 가져오기
            $roles = Role::all();

            // 사용자에게 모든 역할 할당
            foreach ($roles as $role) {
                $user->assignRole($role->name);
            }
        }
    }
}