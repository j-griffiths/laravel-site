<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Notifications\ReplyReceived;

class CommentController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)->latest()->paginate(5);
        foreach ($comments as $comment) {
            $comment['name'] = $comment->profile->user->name;   
        };
        return response()->json([
            'status' => 'success',
            'msg'    => 'Okay',
            'comments' => $comments,
            'pagination' => $comments->links(),
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        try {
            $request->validate([
                'comment'   => 'required|max:5000',
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'status' => 'error',
                'msg'    => 'Error',
                'errors' => $exception->errors(),
            ], 422);
        };

        $user = auth()->user();
        $comment = new Comment();
        $comment->content = $request->comment;
        $comment->profile()->associate($user->profile);
        $post->comments()->save($comment);

        $comment['name'] = $user->name;

        $post->profile->user->notify(new ReplyReceived());
        
        return response()->json([
            'status' => 'success',
            'msg'    => 'Okay',
            'comment' => $comment,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
