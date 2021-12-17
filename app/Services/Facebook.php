<?php

namespace App\Services;

class Facebook
{
    private $api_key;

    public function __construct($api_key)
    {
        $this->api_key = $api_key;
    }

    public function post($text)
    {
        // $head = $post->title;
        // $body = $post->content;
        // $message = $head . $body;

        dd("This is an example post: " . $post . " --- API KEY: " . $this->api_key);
        // Use facebook API here, to act on the user's behalf and post their chosen content on facebook.
    }

    /**
     * Example function to "share" a post that is made on my app to facebook by getting it's URL
     * and using the user's API key to make a facebook post containing the URL.
     */
    public function share($post)
    {
        // $id = $post->id;
        // $url = route('posts.show', ['id' => $id]);

        dd("This is an example share: " . $post . " --- API KEY: " . $this->api_key);
        // Use facebook API here, to share this post to facebook with a URL for embedding.

    }
}
