<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        collect([
            'product-variant-data',
            'product-variant-create',
            'product-variant-update',
            'product-variant-delete',
            'product-variant-show',
        ])->each(fn($permission) => Permission::create(['name' => $permission]));

        collect([
            'product-variant-full-access',
            'product-variant-data-verification',
        ])->each(function ($roleName) {
            $role = Role::create(['name' => $roleName]);
            if ($roleName === 'product-variant-full-access') {
                $role->givePermissionTo([
                    'product-variant-data',
                    'product-variant-create',
                    'product-variant-update',
                    'product-variant-delete',
                    'product-variant-show',
                ]);
            } else {
                $role->givePermissionTo([
                    'product-varian-data',
                    'product-varian-show',
                ]);
            }
        });
    }
}
