<?php

namespace Maxfactor\CMS\Providers;

use Illuminate\Support\Facades\Gate;
use Silvanite\Brandenburg\Traits\ValidatesPermissions;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    use ValidatesPermissions;

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function register()
    {
        $permissions = collect([
            'access_admin',
            'access_admin_users',
            'access_admin_roles',
            'access_admin_permissions',
        ]);

        $permissions->map(function ($permission) {
            Gate::define($permission, function ($user) use ($permission) {
                if ($this->nobodyHasAccess($permission)) {
                    return true;
                }

                return $user->hasRoleWithPermission($permission);
            });
        });
    }
}
