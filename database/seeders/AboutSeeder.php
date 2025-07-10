<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'image' => 'storage/files/about/1.jpg',
            'description' => 'Pratama Solusi Teknologi merupakan perusahaan perseroan terbatas yang bergerak di bidang teknologi informasi, multimedia, advertising, dan event organizer.
             Saat ini kami telah melayani lebih dari 200 klien di seluruh Indonesia. Seiring dengan perkembangan, kami berinisiatif untuk mengelompokkan seluruh produk dan layanan ke dalam 
             suatu sistem yang terintegrasi untuk mewujudkan Smart City, Smart Company, dan Smart Government',
            'vision' => 'Menjadi perusahaan teknologi informasi yang solutif, inovatif, dan kreatif',
            'mission' => 'Menciptakan produk yang inovatif pada perkembangan pasar, mengembangkan teknologi sebagai media penunjang pendidikan dan perekonomian di Indonesia, dan mengembangkan sumber daya manusia yang berkualitas dan kreatif di bidang teknologi',
        ]);
    }
}
