<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', ['posts' => Post::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profid = auth()->user()->id;
        $request->merge(['profile_user_id' => $profid]);
        $request->validate([
            'uploadedFile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $path = null;
        if ($request->hasFile('uploadedFile')) {
            if ($request->file('uploadedFile')->isValid()) {
                $path = $request->uploadedFile->store('public/images');
            }
        }
        $request->merge(['imagePath' => $path]);

        $validatedData = $request->validate([
            'title' => 'required|max:300',
            'content' => 'required|max:10000',
            'profile_user_id' => 'required|integer',
            'imagePath' => 'nullable',
        ]);

        $post = new Post;
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->profile_user_id = $validatedData['profile_user_id'];
        $post->imagePath = $validatedData['imagePath'];
        $post->save();

        session()->flash('message', 'Post was created successfully.');
        return redirect()->route('posts.show', ['post' => $post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
