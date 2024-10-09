<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'name' => 'Gojek',
                'description' => 'Gojek adalah aplikasi penyedia layanan on-demand untuk kebutuhan sehari-hari, seperti layanan transportasi, pesan antar makanan, belanja online, dan lain-lain.',
                "icon" => "icon.png",
            ],
            [
                'name' => 'Shopee',
                'description' => 'Shopee adalah platform e-commerce yang menawarkan berbagai produk dari berbagai kategori, seperti fashion, elektronik, kecantikan, dan masih banyak lagi.',
                "icon" => "icon.png",
            ],
            [
                'name' => 'Grab',
                'description' => 'Grab adalah aplikasi penyedia layanan transportasi dan logistik on-demand, yang juga menyediakan layanan pesan antar makanan dan pembayaran online.',
                "icon" => "icon.png",
            ],
            [
                'name' => 'Tokopedia',
                'description' => 'Tokopedia adalah platform e-commerce yang menawarkan berbagai produk dari berbagai kategori, seperti fashion, elektronik, kecantikan, dan masih banyak lagi.',
                "icon" => "icon.png",
            ],
            [
                'name' => 'Lazada',
                'description' => 'Lazada adalah platform e-commerce yang menawarkan berbagai produk dari berbagai kategori, seperti fashion, elektronik, kecantikan, dan masih banyak lagi.',
                "icon" => "icon.png",
            ],
            [
                'name' => 'Traveloka',
                'description' => 'Traveloka adalah aplikasi penyedia layanan perjalanan yang memungkinkan pengguna memesan tiket pesawat, hotel, paket liburan, dan aktivitas wisata lainnya.',
                "icon" => "icon.png",
            ],
            [
                'name' => 'Blibli',
                'description' => 'Blibli adalah platform e-commerce yang menawarkan berbagai produk dari berbagai kategori, seperti fashion, elektronik, kecantikan, dan masih banyak lagi.',
                "icon" => "icon.png",
            ]
        ])->each(function ($items) {
            DB::table("partners")->insert([
                "name" => $items["name"],
                "description" => $items["description"],
                "icon" => $items["icon"]
            ]);
        });
    }
}
