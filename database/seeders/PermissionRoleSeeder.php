<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        collect([
            'roles-data',
            'roles-create',
            'roles-update',
            'roles-delete',
        ])->each(fn($permission) => Permission::create(['name' => $permission]));

        collect([
            'roles-full-access',
        ])->each(function ($roleName) {
            $role = Role::create(['name' => $roleName]);
            $role->givePermissionTo([
                'roles-data',
                'roles-create',
                'roles-update',
                'roles-delete',

            ]);
        });
    }
}
