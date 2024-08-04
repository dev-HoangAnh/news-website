<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::latest('id')->paginate(3);

        $categories = Category::latest('id')->paginate(10);

        $latestPosts = Post::orderBy('created_at', 'desc')->take(5)->get();
        $mostViewedPosts = Post::orderBy('views', 'desc')->take(2)->get();

        return view('home', compact('latestPosts', 'mostViewedPosts', 'categories', 'posts'));
    }
}
