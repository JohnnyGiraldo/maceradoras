<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Maceradora>
 */
class MaceradoraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'serial' => $this->faker->unique()->uuid, //  "Serial" como clave primaria
            'modelo' => $this->faker->word,
            'estado' => $this->faker->word,
            'fechaFabricacion' => $this->faker->date,
            'tipoAsistencia' => $this->faker->word,
            'fechaInstalacion' => $this->faker->date,
            'tipoMantenimiento' => $this->faker->word,
            'fechaMantenimiento' => $this->faker->date,
            'tipoPieza' => $this->faker->word,
            'fechaCambioPieza' => $this->faker->date,
            'numeroCiclos' => $this->faker->numberBetween(1, 1000),
            'fechaIncidente' => $this->faker->date,
            'observaciones' => $this->faker->work,
            'img' => 'post/' . $this->faker->image('public/storage/posts', 640, 480, null, false),
            'cliente_id' => function () {
                return \App\Models\Cliente::inRandomOrder()->first()->id;
            },
        ];
    }
}
