<?php

namespace Database\Seeders;

use App\Models\Wilaya;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class WilayasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        Wilaya::truncate();
        // Get JSON file content
        $json = File::get(database_path('data/wilayas.json'));
        $wilayas = json_decode($json, true);

        // Insert in chunks for better performance
        $chunks = array_chunk($wilayas, 500);

        foreach ($chunks as $chunk) {
            Wilaya::insert($chunk);
        }
    }
}
