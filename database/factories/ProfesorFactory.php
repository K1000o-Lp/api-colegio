<?php

namespace Database\Factories;

use App\Models\Asignatura;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profesor>
 */
class ProfesorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->firstName(),
            'apellido' => fake()->lastName(),
            'cedula' => strval(fake()->randomNumber(9, true)),
            'asignatura_id' => Asignatura::inRandomOrder()->first()->id,
        ];
    }
}
