<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionReportSeeder extends Seeder
{
    public function run(): void
    {
        //
        collect([
            'report-card-stocks',
            'report-stocks',
            'report-orders',
            'report-pending-over-receives',
            'report-sales',
            'report-best-selling-products',
        ])->each(fn($permission) => Permission::create(['name' => $permission]));

        collect([
            'reports-full-access',
        ])->each(function ($role) {
            $role = Role::create([
                'name' => $role
            ]);

            $role->givePermissionTo([
                'report-card-stocks',
                'report-stocks',
                'report-orders',
                'report-pending-order-receives',
                'report-sales',
                'report-best-selling-products'
            ]);
        });
    }
}
