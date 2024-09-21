<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // User::factory()->count(10)->create();
        // $this->call([
        //     RolesAndPermissionsSeeder::class,
        // ]);
        // $this->call([
        //     // ... 다른 시더들
        //     CreateEditorRoleSeeder::class,
        // ]);
        $this->call([
            AssignRolesToUserSeeder::class,
        ]);
    }
}
