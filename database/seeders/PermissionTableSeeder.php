<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        collect([
            'permission-data',
            'permission-create',
            'permission-update',
            'permission-delete',
        ])->each(fn($permission) => Permission::create(['name' => $permission]));

        collect([
            'permissions-full-access',
        ])->each(function ($roleName) {
            $role = Role::create(['name' => $roleName]);
            $role->givePermissionTo([

                'permission-data',
                'permission-create',
                'permission-update',
                'permission-delete',
            ]);
        });
    }
}
