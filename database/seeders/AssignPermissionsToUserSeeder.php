<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class AssignPermissionsToUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 권한 목록
        $permissions = [
            'edit articles',
            'delete articles',
            'create articles',
            'view articles'
        ];

        // 사용자 ID (예시로 ID가 1인 사용자를 가져옴)
        $userId = 1;

        // 사용자 가져오기
        $user = User::find($userId);

        if ($user) {
            foreach ($permissions as $permissionName) {
                // 권한이 존재하는지 확인하고, 존재하지 않으면 생성
                $permission = Permission::firstOrCreate(['name' => $permissionName]);

                // 사용자에게 권한 할당
                if (!$user->hasPermissionTo($permissionName)) {
                    $user->givePermissionTo($permissionName);
                }
            }

            echo "Permissions assigned to user with ID {$userId}.\n";
        } else {
            echo "User with ID {$userId} not found.\n";
        }
    }
}
