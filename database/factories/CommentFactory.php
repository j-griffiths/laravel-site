<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
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
        /*
         * As my comment model has a polymorphic one-to-many relationship, a float 
         * between 0 and 1 (to 1 decimal place) is generated randomly, and as probability
         * is roughly 50% of being greater than 0.5, equal distribution of comments
         * belonging to a post or another comment in order to test both scenarios.
         */
        $float = $this->faker->randomFloat(1, 0, 1);
        if ($float > 0.5) {
            return [
                'content' => $this->faker->paragraph(),
                'profile_user_id' => Profile::inRandomOrder()->first(),
                'commentable_id' => Post::inRandomOrder()->first(),
                'commentable_type' => Post::class,
            ];
        } else {
            return [
                'content' => $this->faker->paragraph(),
                'profile_user_id' => Profile::inRandomOrder()->first(),
                'commentable_id' => Comment::inRandomOrder()->first(),
                'commentable_type' => Comment::class,
            ];
        }
    }
}
