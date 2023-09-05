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
        // indica que se crearan los registros
        \App\Models\Cliente::factory(5)->create();
        \App\Models\Maceradora::factory(25)->create();
    }
}
