<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newRoles = ['admin', 'user', 'student', 'parent', 'teacher'];

        foreach ($newRoles as $role) {
            Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'web'  // 'web'은 기본 guard name입니다
            ]);
        }
    }
}
