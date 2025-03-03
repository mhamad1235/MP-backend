<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-post',
            'edit-post',
            'delete-post',
            'manage-users',
        ];
        
    foreach ($permissions as $permission) {
        Permission::create(['name' => $permission]);
    }

    // Create roles and assign permissions
    $adminRole = Role::create(['name' => 'admin']);
    $adminRole->givePermissionTo([
        'create-post',
        'edit-post',
        'delete-post',
        'manage-users'
    ]);

    $userRole = Role::create(['name' => 'user']);
    $userRole->givePermissionTo([
        'create-post',
        'edit-post',
    ]);
    }
}
