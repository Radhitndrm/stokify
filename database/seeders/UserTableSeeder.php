<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $role = Role::where('name', 'super-admin')->first();

        $user = User::create([
            'name' => 'Administrator',
            'username' => 'Admin',
            'email' => 'admin@dev.com',
            'password' => bcrypt('password')
        ]);

        $user->assignRole($role);
    }
}
