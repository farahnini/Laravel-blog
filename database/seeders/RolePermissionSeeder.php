<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $editorRole = Role::firstOrCreate(['name' => 'editor']);
        $readerRole = Role::firstOrCreate(['name' => 'reader']);

        // Create permissions
        $permissions = [
            // Article permissions
            'create-articles',
            'edit-articles',
            'delete-articles',
            'view-articles',
            // User permissions
            'create-users',
            'edit-users',
            'delete-users',
            'view-users',
            // Role permissions
            'create-roles',
            'edit-roles',
            'delete-roles',
            'view-roles',
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        $adminRole->syncPermissions($permissions);
        $editorRole->syncPermissions([
            'create-articles', 'edit-articles', 'view-articles',
        ]);
        $readerRole->syncPermissions([
            'view-articles', 'view-users', 'view-roles',
        ]);
    }
} 