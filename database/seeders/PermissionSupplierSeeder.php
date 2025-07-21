<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        collect([
            'supplier-data',
            'supplier-create',
            'supplier-update',
            'supplier-delete',
        ])->each(fn($permission) => Permission::create(['name' => $permission]));

        collect([
            'supplier-full-access',
        ])->each(function ($roleName) {
            $role = Role::create(['name' => $roleName]);
            $role->givePermissionTo([

                'supplier-data',
                'supplier-create',
                'supplier-update',
                'supplier-delete',
            ]);
        });
    }
}
