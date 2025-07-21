<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        collect([
            'stocks-data',
            'stocks-create',
        ])->each(fn($permision) => Permission::create(['name' => $permision]));

        collect([
            'stocks-full-access',
        ])->each(function ($roleName) {
            $role = Role::create(['name' => $roleName]);
            $role->givePermissionTo([
                'stocks-data',
                'stocks-create',
            ]);
        });
    }
}
