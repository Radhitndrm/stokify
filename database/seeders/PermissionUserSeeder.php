<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        collect([
            'users-data',
            'users-create',
            'users-update',
            'users-delete',
            'users-show',
        ])->each(fn($permission) => Permission::create(['name' => $permission]));

        collect([
            'users-full-access',
            'users-data-show',
        ])->each(function ($roleName) {
            $role = Role::create(['name' => $roleName]);
            if ($roleName === 'users-full-access') {
                $role->givePermissionTo([
                    'users-data',
                    'users-create',
                    'users-update',
                    'users-delete',
                    'users-show',
                ]);
            } else {
                $role->givePermissionTo([
                    'users-data',
                    'users-show',
                ]);
            }
        });
    }
}
