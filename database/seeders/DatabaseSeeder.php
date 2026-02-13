<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Prima crea le lezioni e gli slot
        $this->call(MusicSeeder::class);

        // Poi crea gli utenti con le loro prenotazioni
        $this->call(UserSeeder::class);
    }
}
