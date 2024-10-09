<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            'Festival',
            'Fair',
            'Bazar',
            'Konser',
            'Pertandingan',
            'Exhibition',
            'Expo',
            'Pameran',
            'Konferensi',
            'Workshop',
            'Pertunjukkan',
            'Atraksi',
            'Theme Park',
            'Akomodasi',
            'Seminar',
            'Talk Show',
            'Social Gathering',
            'Training',
            'Sertifikasi',
            'Ujian',
            'Pensi',
            'Event Sekolah',
            'Kampus',
            'Trip',
            'Tur',
            'Tournamen',
            'Kompetisi',
            'Lainnya'
        ])->each(function ($items) {
            DB::table("formats")->insert([
                "name" => $items
            ]);
        });
    }
}
