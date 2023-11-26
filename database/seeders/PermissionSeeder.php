<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create application']);
        Permission::create(['name' => 'show application']);
        Permission::create(['name' => 'update application']);
        Permission::create(['name' => 'delete application']);


    }
}
