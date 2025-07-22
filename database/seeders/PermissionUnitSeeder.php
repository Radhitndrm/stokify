<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        collect([
            'units-data',
            'units-create',
            'units-update',
            'units-delete',
        ])->each(fn($permission) => Permission::create(['name' => $permission]));

        collect([
            'units-full-access',
        ])->each(function ($roleName) {
            $role = Role::create(['name' => $roleName]);
            $role->givePermissionTo([
                'units-data',
                'units-create',
                'units-update',
                'units-delete',
            ]);
        });
    }
}
