<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Portofolio;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PortofolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 6) as $portofolio) {
            Portofolio::create([
                'image' => 'storage/files/portofolio/1.png',
                'category' => "category $portofolio",
                'title' => "title $portofolio",
                'description' => "description $portofolio",
                'tanggal' => Carbon::create(2025, 7, 10),
            ]);
        }
    }
}
