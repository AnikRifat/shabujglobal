<?php


namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample data for applications table
        Application::create([
            'subject' => 'Sample Application 1',
            'description' => 'This is a sample application description.',
            'status' => 1,
            'user_id' => 3, // Replace with an existing user ID
        ]);

        Application::create([
            'subject' => 'Sample Application 2',
            'description' => 'Another sample application description.',
            'status' => 2,
            'user_id' => 3, // Replace with an existing user ID
        ]);

        // Add more sample data as needed
    }
}
