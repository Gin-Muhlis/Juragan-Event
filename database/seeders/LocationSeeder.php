<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
            DB::table("locations")->insert([
                "location" => $items
            ]);
        });
    }
}
