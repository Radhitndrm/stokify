<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        collect([
            'orders-data',
            'orders-create',
            'orders-update',
            'orders-delete',
            'orders-verification',
            'orders-show',
        ])->each(fn($permission) => Permission::create(['name' => $permission]));

        collect([
            'order-full-access',
            'order-data-verification',
        ])->each(function ($roleName) {
            $role = Role::create(['name' => $roleName]);

            if ($roleName === 'order-full-access') {
                $role->givePermissionTo([
                    'orders-data',
                    'orders-create',
                    'orders-update',
                    'orders-delete',
                    'orders-verification',
                    'orders-show',
                ]);
            } else {
                $role->givePermissionTo([
                    'orders-data',
                    'orders-show',
                    'orders-verification',
                ]);
            }
        });
    }
}
