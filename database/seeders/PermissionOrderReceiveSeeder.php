<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionOrderReceiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        collect([
            'order-receives-data',
            'order-receives-create',
            'order-receives-update',
            'order-receives-delete',
            'order-receives-show',
            'order-receives-verification',
        ])->each(fn($permission) => Permission::create(['name' => $permission]));

        collect([
            'order-receive-full-access',
            'order-receive-data-verification',
        ])->each(function ($roleName) {
            $role = Role::create(['name' => $roleName]);

            if ($roleName === 'order-receive-full-access') {
                $role->givePermissionTo([
                    'order-receives-data',
                    'order-receives-create',
                    'order-receives-update',
                    'order-receives-delete',
                    'order-receives-show',
                    'order-receives-verification'
                ]);
            } else {
                $role->givePermissionTo([
                    'order-receives-data',
                    'order-receives-show',
                    'order-receives-verification'
                ]);
            }
        });
    }
}
