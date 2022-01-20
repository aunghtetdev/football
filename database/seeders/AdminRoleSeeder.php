<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'user', 'guard_name' => 'admin']);
        Permission::create(['name' => 'match', 'guard_name' => 'admin']);
        Permission::create(['name' => 'odds', 'guard_name' => 'admin']);
        Permission::create(['name' => 'role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'league', 'guard_name' => 'admin']);
        Permission::create(['name' => 'team', 'guard_name' => 'admin']);
        Permission::create(['name' => 'balance', 'guard_name' => 'admin']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'Admin', 'guard_name' => 'admin']);
        $role1->givePermissionTo('admin');
        $role1->givePermissionTo('user');
        $role1->givePermissionTo('match');
        $role1->givePermissionTo('odds');
        $role1->givePermissionTo('role');
        $role1->givePermissionTo('permission');
        $role1->givePermissionTo('league');
        $role1->givePermissionTo('team');
        $role1->givePermissionTo('balance');
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = AdminUser::create([
            'username' => 'kaungchit',
            'password' => Hash::make('1234567890'),
        ]);
        $user->assignRole($role1);
    }
}
