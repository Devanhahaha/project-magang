<?php

namespace Database\Seeders;

use App\Models\Home;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Home::create([
            'banner' => 'storage/files/banner/1.png',
            'title' => 'Solusi Teknologi Terdepan Untuk Kemajuan Bisnis Anda',
            'subtitle' => 'CV Ramah Teknologi adalah mitra terpercaya dalam menghadirkan layanan teknologi inovasi, efisiensi, dan berkelanjutan untuk mendukung pertumbuhan bisnis di era digital',
        ]);
    }
}
