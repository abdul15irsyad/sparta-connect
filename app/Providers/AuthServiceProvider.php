<?php

namespace App\Providers;

use App\Models\AdminPermission;
use App\Models\AdminUser;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // admin gates
        $permissions = AdminPermission::all();

        foreach ($permissions as $permission) {
            Gate::define($permission->slug, function ($admin_user) use ($permission) {
                // if admin have permission
                return AdminUser::where('id', auth('admin')->user()->id ?? $admin_user->id)
                    ->with(['admin_role.admin_permissions'])
                    ->whereHas('admin_role.admin_permissions', fn ($query) => $query->where('slug', $permission->slug))
                    ->first();
            });
        }
    }
}
