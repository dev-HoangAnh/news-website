<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->increment('views');

        $comments = $post->comments()->latest()->get();

        return view('posts.show', compact('post', 'comments'));
    }

}
