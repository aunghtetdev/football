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

        // firstOrCreate permissions
        Permission::firstOrCreate(['name' => 'admin', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'user', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'match', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'odds', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'role', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'permission', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'league', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'team', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'balance', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'add_balance', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'substract_balance', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'view_balance_history', 'guard_name' => 'admin']);

        // firstOrCreate roles and assign existing permissions
        $role1 = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'admin']);
        $role1->givePermissionTo('admin');
        $role1->givePermissionTo('user');
        $role1->givePermissionTo('match');
        $role1->givePermissionTo('odds');
        $role1->givePermissionTo('role');
        $role1->givePermissionTo('permission');
        $role1->givePermissionTo('league');
        $role1->givePermissionTo('team');
        $role1->givePermissionTo('balance');
        $role1->givePermissionTo('add_balance');
        $role1->givePermissionTo('substract_balance');
        $role1->givePermissionTo('view_balance_history');
        $role1->givePermissionTo('bet');
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // firstOrCreate demo users
        $user = AdminUser::firstOrCreate([
            'username' => 'admin',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole($role1);
    }
}
