<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pais' => $this->faker->country,
            'ciudad' => $this->faker->city,
            'institucion' => $this->faker->company,
            'email' => $this->faker->email,
            'telefono' => $this->faker->e164PhoneNumber,
            'direccion' => $this->faker->address,
        ];
    }
}
