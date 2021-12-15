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
        $maxUsers = User::get()->count();
        return [
            'user_id' => $this->faker->unique()->numberBetween(1, $maxUsers),
            'display_name' => $this->faker->name(),
            'profession' => $this->faker->jobTitle(),
            'website' => $this->faker->url(),
            'biography' => $this->faker->paragraph(),
        ];
    }
}
