<?php

namespace Database\Seeders;

use App\Models\EventCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'name' => 'Festival, Fair, Bazaar',
                'description' => 'Experience the local culture and tradition by visiting various festivals, fairs, and bazaars.'
            ],
            [
                'name' => 'Konser',
                'description' => 'Enjoy live music performances from your favorite artists and bands at concerts.'
            ],
            [
                'name' => 'Pertandingan',
                'description' => 'Witness thrilling competitions and matches in various sports and games.'
            ],
            [
                'name' => 'Exhibition, Expo, Pameran',
                'description' => 'Explore the latest trends and innovations in various industries through exhibitions, expos, and trade shows.'
            ],
            [
                'name' => 'Konferensi',
                'description' => 'Join conferences and seminars to learn from experts and network with professionals in your field.'
            ],
            [
                'name' => 'Workshop',
                'description' => 'Gain new skills and knowledge through hands-on workshops and training sessions.'
            ],
            [
                'name' => 'Pertunjukan',
                'description' => 'Be entertained by amazing performances, such as theater plays, dance shows, and magic shows.'
            ],
            [
                'name' => 'Atraksi, Theme Park',
                'description' => 'Experience thrilling rides and attractions at theme parks and amusement parks.'
            ],
            [
                'name' => 'Akomodasi',
                'description' => 'Find comfortable and convenient accommodation for your travel needs, such as hotels, resorts, and homestays.'
            ],
            [
                'name' => 'Seminar, Talk Show',
                'description' => 'Attend informative and inspiring talks and seminars on various topics and issues.'
            ],
            [
                'name' => 'Social Gathering',
                'description' => 'Connect with like-minded individuals and build relationships through social gatherings, such as meetups, parties, and dinners.'
            ],
            [
                'name' => 'Training, Sertifikasi, Ujian',
                'description' => 'Get certified and improve your career prospects by taking training courses and exams.'
            ],
            [
                'name' => 'Pensi, Event Sekolah, Kampus',
                'description' => 'Join events and activities organized by your school or university, such as reunions, festivals, and competitions.'
            ],
            [
                'name' => 'Trip, Tur',
                'description' => 'Explore new places and cultures by joining organized trips and tours.'
            ],
            [
                'name' => 'Turnamen, Kompetisi',
                'description' => 'Compete against other individuals or teams in tournaments and competitions.'
            ]
        ])->each(function ($items) {
            DB::table("event_categories")->insert($items);
        });
    }
}
