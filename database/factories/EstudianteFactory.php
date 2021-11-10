<?php

namespace Database\Factories;

use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstudianteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Estudiante::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombres' => $this->faker->name(),
            'apellidos' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'tel' => $this->faker->numerify('(###) ### ####'),
            'programa_id' => 1,
            'estado_llamada' => 1,
        ];
    }
}
