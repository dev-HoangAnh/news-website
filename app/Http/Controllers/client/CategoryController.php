<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->posts()->orderBy('created_at', 'desc')->paginate(10);

        $categories = Category::latest('id')->paginate(10);

        return view('categories.find', compact('category', 'posts', 'categories'));
    }
}
