<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JuraganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('juragans')->insert([
            'banner_website' => 'public/ajGO9mW9yldAOswRZH1EAVC49iyUW68LrpZS2A7l.jpg',
            'address' => 'Kampung Cigombong No. 64 Kecamatan Pacet, Cianjur Jawa Barat Indonesia, 43253',
            'email' => 'meet@madtive.com',
            'phone_number' => '087836370765',
            'copyright_text' => 'All Right Reserved, Powered by Madtive Studio',
            'short_description' => 'Juragan Event, Penyedia layanan pembelian tiket dan pembuatan event di wilayah Jawa Barat.',
            'long_description' => '<p class="fs-6 font-weight-light" style="font-family: Poppins, sans-serif; text-indent: 30px; font-size: 1rem !important;">Juragan Event adalah platform terkemuka untuk pembelian tiket, pembuatan event, dan informasi terkini seputar berita mengenai Juragan Event dan berita di Provinsi Jawa Barat. Kami hadir untuk memudahkan Anda dalam menikmati dan mengatur event-event menarik di wilayah ini. Dengan antarmuka yang user-friendly dan fitur lengkap, kami menyediakan layanan yang dapat memenuhi kebutuhan Anda dalam dunia event.</p><p class="fs-6 font-weight-light" style="font-family: Poppins, sans-serif; font-size: 1rem !important;">Beberapa fitur yang kami sediakan untuk memudahkan para pencari event dan pembuat event di website kami :</p><ul class="fs-6 font-weight-light" style="font-family: Poppins, sans-serif; padding-left: 2rem; font-size: 1rem !important;"><li>Mencari berbagai event yang tersedia di Jawa Barat</li><li>Pembuatan event yang mudah dan lengkap</li><li>Sistem analisis data yang lengkap setelah acara berlangsung untuk memudahkan penyelenggara event dalam menentukan strategi event selanjutnya</li><li>Customer service bersedia melayani anda selama 24 jam</li></ul>',
            'contact_description' => 'Kami akan senang jika bisa mendengar apa yang ingin anda sampaikan, jadi jangan ragu untuk menghubungi kami.',
            'coordinate' => '-6.816354569170903, 107.14091381006918',
            'logo_website' => 'public/4DrJtRaEWsDqh5DxJVcQJ5di4DLs2MNor9oBxG0v.png',
            'link_fb' => 'https://facebook.com',
            'link_twitter' => 'https://twitter.com',
            'link_instagram' => 'https://instagram.com',
            'link_youtube' => 'https://youtube.com'
        ]);
    }
}
