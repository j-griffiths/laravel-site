<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $test = $this->faker->randomFloat(1, 0, 1);
        if ($test > 0.5) {
            return [
                'content' => $this->faker->paragraph(),
                'user_id' => User::inRandomOrder()->first(),
                'commentable_id' => Post::inRandomOrder()->first(),
                'commentable_type' => "Post",
            ];
        } else {
            return [
                'content' => $this->faker->paragraph(),
                'user_id' => User::inRandomOrder()->first(),
                'commentable_id' => Comment::inRandomOrder()->first(),
                'commentable_type' => "Comment",
            ];
        }
    }
}
