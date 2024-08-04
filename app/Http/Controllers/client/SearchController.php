<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $posts = Post::where('title', 'LIKE', "%{$query}%")
                      ->orWhere('content', 'LIKE', "%{$query}%")
                      ->paginate(10);

        // Kiểm tra nếu không có kết quả
        if ($posts->isEmpty()) {
            // Trả về trang lỗi tùy chỉnh
            return response()->view('search.not-found', compact('query'));
        }

        return view('search.results', compact('posts', 'query'));
    }
}
