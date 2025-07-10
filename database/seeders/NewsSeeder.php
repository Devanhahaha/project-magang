<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(range(1, 3) as $news) {
            News::create([
                'image' => 'storage/files/news/1.jpg',
                'category' => "category $news",
                'title' => "title $news",
                'description' => "description $news",
                'tanggal' => Carbon::create(2025, 7, 9),
            ]);
        }
    }
}
