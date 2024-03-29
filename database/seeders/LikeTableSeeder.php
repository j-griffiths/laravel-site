<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class LikeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::get();
        $comments = Comment::get();
        $profiles = Profile::get();
        $profiles->first()->likedPosts()->attach(1);
        $profiles->first()->likedComments()->attach(1);
        $posts->where('id', '2')->first()->likes()->attach(1);
        $comments->where('id', '2')->first()->likes()->attach(1);

        Like::factory(10)->make();
    }
}
