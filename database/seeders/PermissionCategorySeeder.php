<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Buat permission
        collect([
            'categories-data',
            'categories-create',
            'categories-update',
            'categories-delete',
        ])->each(fn($permission) => Permission::create(['name' => $permission]));

        // Buat role dan berikan permission
        collect(['categories-full-access'])->each(function ($roleName) {
            $role = Role::create(['name' => $roleName]);

            $role->givePermissionTo([
                'categories-data',
                'categories-create',
                'categories-update',
                'categories-delete',
            ]);
        });
    }
}
