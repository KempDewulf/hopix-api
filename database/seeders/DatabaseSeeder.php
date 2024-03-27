<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LanguageSeeder::class,
            BrewerySeeder::class,
            AromaSeeder::class,
            BeerSeeder::class,
            AromaLanguageSeeder::class,
            UserSeeder::class,
            BeerLanguageSeeder::class,
        ]);
    }
}
