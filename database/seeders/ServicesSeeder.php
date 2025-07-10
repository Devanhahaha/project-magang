<?php

namespace Database\Seeders;

use App\Models\Services;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 5) as $services) {
            Services::create([
                'banner' => 'storage/files/services/1.png',
                'title' => "title $services",
                'subtitle' => "subtitle $services",
                'description' => "description $services",
            ]);
        }
    }
}
