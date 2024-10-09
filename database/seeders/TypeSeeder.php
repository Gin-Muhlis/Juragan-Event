<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            "online",
            "offline"
        ])->each(function ($types) {
            DB::table("types")->insert([
                "name" => $types
            ]);
        });
    }
}
