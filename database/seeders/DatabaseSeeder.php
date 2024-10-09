<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admeen@admeen.com',
                'password' => Hash::make('admeen77'),
                'phone_number' => 0,
            ]);
        \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'creator@creator.com',
                'password' => Hash::make('creator77'),
                'phone_number' => 0,
            ]);
        $this->call(PermissionsSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(PartnerSeeder::class);
        $this->call(TopicSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(FormatSeeder::class);
        $this->call(JuraganSeeder::class);
    }
}
