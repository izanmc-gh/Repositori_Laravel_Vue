<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reserva>
 */
class ReservaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->name(),
            'data' => $this->faker->date(),
            'email' => $this->faker->name(),
            'telefon' => $this->faker->name(),
            'pais' => $this->faker->name(),
            'remember_token' => Str::random(10),
        ];
    }
}
