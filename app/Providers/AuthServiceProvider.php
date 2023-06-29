<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $user = User::find(1);
//        Role::create(['name' => 'admin']);
        $role = Role::findByName('admin');
        $user->assignRole(['admin']);
//
//        Permission::create(['name' => 'viewAny_user']);
//        Permission::create(['name' => 'view_user']);
//        Permission::create(['name' => 'update_user']);
//        Permission::create(['name' => 'delete_user']);
//        Permission::create(['name' => 'restore_user']);
//        Permission::create(['name' => 'forceDelete_user']);
//
//        Permission::create(['name' => 'viewAny_client']);
//        Permission::create(['name' => 'view_client']);
//        Permission::create(['name' => 'update_client']);
//        Permission::create(['name' => 'delete_client']);
//        Permission::create(['name' => 'restore_client']);
//        Permission::create(['name' => 'forceDelete_client']);

        $role->givePermissionTo('viewAny_user');
        $role->givePermissionTo('view_user');
        $role->givePermissionTo('update_user');
        $role->givePermissionTo('delete_user');
        $role->givePermissionTo('restore_user');
        $role->givePermissionTo('forceDelete_user');

        $role->givePermissionTo('viewAny_client');
        $role->givePermissionTo('view_client');
        $role->givePermissionTo('update_client');
        $role->givePermissionTo('delete_client');
        $role->givePermissionTo('restore_client');
        $role->givePermissionTo('forceDelete_client');

        $user->givePermissionTo('viewAny_client');
        $user->givePermissionTo('view_client');
    }
}
