<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('posts');// Elimina tambien las imagenes de la carpeta 
        Storage::makeDirectory('posts');// Crea la Carpeta con las migraciones 


        \App\Models\Cliente::factory(5)->create();
        \App\Models\Maceradora::factory(25)->create();
    }
}
