<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post;
        $post->title = "This is an example title.";
        $post->content = "This is an example of content that a post could include.";
        $post->user_id = 1;
        $post->save();

        Post::factory(10)->create();
    }
}
