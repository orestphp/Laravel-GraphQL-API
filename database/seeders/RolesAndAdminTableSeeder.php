<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\PermissionRegistrar;

/**
 * To run independently - php artisan db:seed --class=RolesTableSeeder
 *
 * Class RolesTableSeeder
 * @package Database\Seeders
 */
class RolesAndAdminTableSeeder extends Seeder
{

    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->truncateMultiple([
            config('permission.table_names.model_has_permissions'),
            config('permission.table_names.model_has_roles'),
            config('permission.table_names.role_has_permissions'),
            config('permission.table_names.permissions'),
            config('permission.table_names.roles'),
            'users',
            'password_resets',
        ]);

        // Admin
        $adminRole = Role::create(['name' => 'admin']);

        // Manager
        Role::create(['name' => 'manager']);

        // User
        Role::create(['name' => 'user']);

        // Create 'user' and assign 'roles' ('roles' can be array)
        $admin = User::create([
            'name' => "Admin",
            'first_name' => "Jon",
            'last_name' => "Jonson",
            'password' => bcrypt('admini'),
            'email' => "admin@admin.com",
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        $admin = User::create([
            'name' => "Manager",
            'first_name' => "Brad",
            'last_name' => "Pitt",
            'password' => bcrypt('manager'),
            'email' => "man@man.com",
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('manager');

        $this->enableForeignKeys();
    }
}
