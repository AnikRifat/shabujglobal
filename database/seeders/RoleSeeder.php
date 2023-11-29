<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin'])->givePermissionTo([1, 2, 3, 4]);
        Role::create(['name' => 'student'])->givePermissionTo([1, 2]);
        Role::create(['name' => 'teacher'])->givePermissionTo([2, 3]);

    }
}
