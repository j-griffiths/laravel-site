<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\Facebook;

class PostController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::paginate(10)
        ]);
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
        $request->validate([
            'uploadedFile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $path = null;
        if ($request->hasFile('uploadedFile')) {
            if ($request->file('uploadedFile')->isValid()) {
                $path = $request->uploadedFile->store('images');
            }
        }
        $request->merge(['imagePath' => $path]);

        $validatedData = $request->validate([
            'title' => 'required|max:300',
            'content' => 'required|max:10000',
            'imagePath' => 'nullable'
        ]);

        $post = new Post;
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->imagePath = $validatedData['imagePath'];
        auth()->user()->profile->posts()->save($post);

        session()->flash('message', 'Post Created Successfully!');
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
        return view('posts.edit', ['post' => $post]);
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
        $request->validate([
            'uploadedFile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $path = null;
        if ($request->hasFile('uploadedFile')) {
            if ($request->file('uploadedFile')->isValid()) {
                $path = $request->uploadedFile->store('images');
                if ($post->imagePath) {
                    Storage::delete($post->imagePath);
                }
            }
        }

        $validatedData = $request->validate([
            'title' => 'required|max:300',
            'content' => 'required|max:10000',
        ]);

        $request->merge(['imagePath' => $path]);

        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        if ($path) {
            $post->imagePath = $path;
        }
        $post->save();

        session()->flash('message', 'Post Updated Successfully!');
        return redirect()->route('posts.show', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Storage::delete($post->imagePath);
        $post->delete();
        session()->flash('message', 'Post Deleted Successfully!');
        return redirect()->route('posts.index');
    }

    public function shareToFacebook($example, Facebook $fb)
    {
        $fb->share($example);
    }
}
