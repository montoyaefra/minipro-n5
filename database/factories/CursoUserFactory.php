<?php

namespace Database\Factories;

use App\Models\Curso;
use App\Models\CursoUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CursoUser>
 */
class CursoUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CursoUser::class;
    public function definition(): array
    {
        $cursoId = Curso::inRandomOrder()->first()->id;
        $userId = User::inRandomOrder()->first()->id;

        return [
            'cursos_id' => $cursoId,
            'user_id' => $userId,
        ];
    }
}


