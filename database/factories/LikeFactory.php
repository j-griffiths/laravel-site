<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $float = $this->faker->randomFloat(1, 0, 1);
        if ($float > 0.5) {
            return [
                User::inRandomOrder()->first()->likedPosts()->attach(Post::inRandomOrder()->first()),
            ];
        } else {
            return [
                User::inRandomOrder()->first()->likedComments()->attach(Comment::inRandomOrder()->first()),
            ];
        }
    }
}
