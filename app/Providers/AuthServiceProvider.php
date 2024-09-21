<?php

namespace App\Providers;

use App\Models\Team;
use App\Policies\TeamPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        // 모든 권한을 가져옴
        $permissions = Permission::all();

        // 각 권한에 대해 게이트를 정의
        foreach ($permissions as $permission) {
            Gate::define($permission->name, function (User $user) use ($permission) {
                // role_has_permissions 테이블에서 해당 권한을 가진 역할을 가져옴
                $roleIds = DB::table('role_has_permissions')
                    ->where('permission_id', $permission->id)
                    ->pluck('role_id')
                    ->toArray();

                // 사용자가 해당 역할을 가지고 있는지 확인
                foreach ($roleIds as $roleId) {
                    $role = Role::findById($roleId, 'web'); // 'web' 가드를 사용하여 역할을 찾음
                    if ($user->hasRole($role->name)) {
                        return true;
                    }
                }
                return false;
            });
        }
    }
}
