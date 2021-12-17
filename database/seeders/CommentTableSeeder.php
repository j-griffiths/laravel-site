<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment = new Comment;
        $comment->content = "This is an example of content that a comment could include.";
        $comment->profile_id = 1;
        $comment->post_id = 1;
        $comment->save();

        $comment = new Comment;
        $comment->content = "This is a sub-comment.";
        $comment->profile_id = 2;
        $comment->post_id = 1;
        $comment->save();

        Comment::factory(50)->create();
    }
}
