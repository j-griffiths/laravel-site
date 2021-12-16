<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Notifications\ReplyReceived;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->commonValidation($request);

        $profile = auth()->user()->profile;
        if ($request->likeable_type === 'post') {
            $post = Post::find($request->likeable_id);
            if( $profile->likedPosts->contains($post) ) {
                return response()->json([
                    'status' => 'error',
                    'msg'    => 'Error',
                    'errors' => ['You have already liked this post.'],
                ], 422);
            }
            $post->likes()->attach($profile);
            $post->profile->user->notify(new ReplyReceived());
            return response()->json([
                'status' => 'success',
                'msg'    => 'Okay',
                'message' => 'Liked Post Successfully!',
            ], 201);
        } else if ($request->likeable_type === 'comment') {
            $comment = Comment::find($request->likeable_id);
            if( $profile->likedComments->contains($comment) ) {
                return response()->json([
                    'status' => 'error',
                    'msg'    => 'Error',
                    'errors' => ['You have already liked this comment.'],
                ], 422);
            }
            $comment->likes()->attach($profile);
            $comment->profile->user->notify(new ReplyReceived());
            return response()->json([
                'status' => 'success',
                'msg'    => 'Okay',
                'message' => 'Liked Comment Successfully!',
            ], 201);
        };
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
    public function destroy(Request $request)
    {

        $this->commonValidation($request);

        $profile = auth()->user()->profile;
        if ($request->likeable_type === 'post') {
            $post = Post::find($request->likeable_id);
            if( !$profile->likedPosts->contains($post) ) {
                return response()->json([
                    'status' => 'error',
                    'msg'    => 'Error',
                    'errors' => ['You have not liked this post.'],
                ], 422);
            }
            $post->likes()->detach($profile);
            return response()->json([
                'status' => 'success',
                'msg'    => 'Okay',
                'message' => 'Unliked Post Successfully!',
            ], 201);
        } else if ($request->likeable_type === 'comment') {
            $comment = Comment::find($request->likeable_id);
            if( !$profile->likedComments->contains($comment) ) {
                return response()->json([
                    'status' => 'error',
                    'msg'    => 'Error',
                    'errors' => ['You have not liked this comment.'],
                ], 422);
            }
            $comment->likes()->detach($profile);
            return response()->json([
                'status' => 'success',
                'msg'    => 'Okay',
                'message' => 'Unliked Comment Successfully!',
            ], 201);
        };
    }

    private function commonValidation(Request $request) {
        $p = 'post';
        $c = 'comment';
        $validTypesString = $p . ',' . $c;
        try {
            $request->validate([
                'likeable_id'   => 'required|integer',
                'likeable_type' => 'required|in:' . $validTypesString, 
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'status' => 'error',
                'msg'    => 'Error',
                'errors' => $exception->errors(),
            ], 422);
        };
        $existsString = $request->likeable_type . 's,id';
        try {
            $request->validate([
                'likeable_id'   => 'exists:' . $existsString,
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'status' => 'error',
                'msg'    => 'Error',
                'errors' => $exception->errors(),
            ], 422);
        };
    }
}
