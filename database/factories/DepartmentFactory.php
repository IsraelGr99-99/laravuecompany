<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Agregamos registros falsos
            'name' => $this->faker->jobTitle(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->e164PhoneNumber(),
            'name' => $this->faker->numberBetween(1,6),
        ];
    }
}
