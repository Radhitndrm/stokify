<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        collect([
            'sales-data',
            'sales-create',
            'sales-show',
        ])->each(fn($permission) => Permission::create(['name' => $permission]));


        collect([
            'sales-full-access',
        ])->each(function ($roleName) {
            $role = Role::create(['name' => $roleName]);
            $role->givePermissionTo([
                'sales-data',
                'sales-create',
                'sales-show',
            ]);
        });
    }
}
