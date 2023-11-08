<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Alumno;
use App\Models\Asignatura;
use App\Models\Profesor;
use App\Models\Calificacion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Alumno::factory(50)->create();
        Asignatura::factory(50)->create();
        Profesor::factory(50)->create();
        Calificacion::factory(50)->create();
    }
}
