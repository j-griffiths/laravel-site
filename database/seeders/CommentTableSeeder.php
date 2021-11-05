<?php

namespace Database\Seeders;

use App\Models\Comment;
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
        $comment->user_id = 1;
        $comment->commentable_id = 1;
        $comment->commentable_type = "Post";
        $comment->save();

        $comment = new Comment;
        $comment->content = "This is a sub-comment.";
        $comment->user_id = 2;
        $comment->commentable_id = 1;
        $comment->commentable_type = "Comment";
        $comment->save();

        Comment::factory(10)->create();
    }
}
