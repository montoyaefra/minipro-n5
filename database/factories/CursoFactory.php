<?php

namespace Database\Factories;

use App\Models\Curso;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curso>
 */
class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        $nombresCursos = ['Matemáticas', 'Ciencias', 'Sociales', 'Inglés', 'Computación', "Programacion"];
        $nombreAleatorio = $this->faker->unique()->randomElement($nombresCursos);

        return [
            'nombre' => $nombreAleatorio,
        ];
        
    }
}
