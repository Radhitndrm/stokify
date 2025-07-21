<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        collect([
            'product-data',
            'product-create',
            'product-update',
            'product-delete',
            'product-show',
        ])->each(fn($permission) => Permission::create(['name' => $permission]));

        collect([
            'product-full-access',
            'product-data-verification',
        ])->each(function ($roleName) {
            $role = Role::create(['name' => $roleName]);
            if ($roleName === 'product-full-accesss') {
                $role->givePermissionTo([
                    'product-data',
                    'product-create',
                    'product-update',
                    'product-delete',
                    'product-show',
                ]);
            } else {
                $role->givePermissionTo([
                    'product-data',
                    'product-show',
                ]);
            }
        });
    }
}
