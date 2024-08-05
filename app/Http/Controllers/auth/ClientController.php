<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function dashboard()
    {
        $posts = Post::latest('id')->paginate(3);

        $categories = Category::latest('id')->paginate(10);

        $latestPosts = Post::orderBy('created_at', 'desc')->take(5)->get();
        $mostViewedPosts = Post::orderBy('views', 'desc')->take(2)->get();

        return view('home', compact('latestPosts', 'mostViewedPosts', 'categories', 'posts'));
    }
}
