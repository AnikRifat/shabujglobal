<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\File;

class FilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample data for files table
        File::create([
            'application_id' => 1, // Replace with an existing application ID
            'file' => 'path/to/sample-file1.pdf',
        ]);

        File::create([
            'application_id' => 2, // Replace with an existing application ID
            'file' => 'path/to/sample-file2.docx',
        ]);

        // Add more sample data as needed
    }
}
