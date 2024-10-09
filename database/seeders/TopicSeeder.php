<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            'Anak',
            'Keluarga',
            'Bisnis',
            'Desain',
            'Foto',
            'Video',
            'Fashion',
            'Kecantikan',
            'Film',
            'Sinema',
            'Game',
            'E-Sport',
            'Hobi',
            'Kerajinan Tangan',
            'Investasi',
            'Saham',
            'Karir',
            'Pengembangan Diri',
            'Agama',
            'Kesehatan',
            'Kebugaran',
            'Keuangan',
            'Finansial',
            'Lingkungan Hidup',
            'Makanan',
            'Minuman',
            'Marketing',
            'Musik',
            'Olahraga',
            'Otomotif',
            'Sains',
            'Teknologi',
            'Seni',
            'Budaya',
            'Hukum',
            'Politik',
            'Standup Comedy',
            'Pendidikan',
            'Beasiswa',
            'Tech',
            'Star-Up',
            'Wisata',
            'Liburan',
            'Lainnya'
        ])->each(function ($items) {
            DB::table("topics")->insert([
                "name" => $items
            ]);
        });
    }
}
