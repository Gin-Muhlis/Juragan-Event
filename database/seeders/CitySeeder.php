<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        collect([
            'Bandung',
            'Bekasi',
            'Bogor',
            'Cimahi',
            'Cirebon',
            'Depok',
            'Sukabumi',
            'Tasikmalaya',
            'Banjar',
            'Bekasi Timur',
            'Garut',
            'Karawang',
            'Kuningan',
            'Majalengka',
            'Purwakarta',
            'Subang',
            'Sumedang',
            'Cianjur',
            'Indramayu',
            'Pangandaran',
        ])->each(function ($items) {
            DB::table("cities")->insert([
                "city_name" => $items
            ]);
        });
    }
}
