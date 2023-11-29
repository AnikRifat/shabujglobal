<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@sge.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Teacher User',
            'email' => 'teacher@sge.com',
            'password' => bcrypt('password'),
            'role' => 'teacher',
        ]);

        User::factory()->create([
            'name' => 'Student User',
            'email' => 'student@sge.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

    }
}
