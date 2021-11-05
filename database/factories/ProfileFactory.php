<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first(),
            'forename' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'profession' => $this->faker->jobTitle(),
            'website' => $this->faker->url(),
            'biography' => $this->faker->paragraph(),
        ];
    }
}
