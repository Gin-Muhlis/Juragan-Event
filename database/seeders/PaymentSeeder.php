<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'name' => 'Gopay',
                'icon' => 'icon.png',
                'fee_service' => 0
            ],
            [
                'name' => 'Cash',
                'icon' => 'icon.png',
                'fee_service' => 0
            ],
            [
                'name' => 'Debit Card',
                'icon' => 'icon.png',
                'fee_service' => 0
            ],
            [
                'name' => 'Credit Card',
                'icon' => 'icon.png',
                'fee_service' => 0
            ],
            [
                'name' => 'Transfer Bank',
                'icon' => 'icon.png',
                'fee_service' => 0
            ],
            [
                'name' => 'OVO',
                'icon' => 'icon.png',
                'fee_service' => 0
            ],
            [
                'name' => 'DANA',
                'icon' => 'icon.png',
                'fee_service' => 0
            ],
        ])->each(function ($item) {
            DB::table('payments')->insert($item);
        });
    }
}
