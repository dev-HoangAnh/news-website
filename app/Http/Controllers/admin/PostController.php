<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user', 'category', 'users')->latest('id')->paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate(
            [
                'title' => 'required|string|max:255',
                'image' => 'nullable',
                'content' => 'required|string',
            ],
            [
                'title.required' => 'Không để trống tiêu đề',
                'title.max' => 'Tiêu đề không được lớn hơn 255 ký tự',
                'content.required' => 'Không để trống nội dung',
            ]
        );

        try {
            DB::transaction(function () use ($request, $validatedData) {
                $imagePath = $request->except('image');

                if ($request->hasFile('image')) {
                    $imagePath = Storage::put('posts', $request->file('image'));
                }

                $post = Post::create([
                    'user_id' => auth()->id(),
                    'category_id' => $request->category_id,
                    'title' => $validatedData['title'],
                    'image' => $imagePath,
                    'content' => $validatedData['content'],
                ]);

                // Gắn người dùng hiện tại vào bảng trung gian
                $post->users()->attach(auth()->id());

            });

            return redirect()->route('posts.index')->with('success', 'Thêm bản tin thành công.');

        } catch (Exception $e) {
            Log::error(($e instanceof QueryException ? 'Database query error: ' : 'Unexpected error: ') . $e->getMessage());

            return redirect()
                ->route('posts.index')
                ->with('error', $e instanceof QueryException ? 'Failed to create post.' : 'An unexpected error occurred.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        try {
            DB::transaction(function () use ($request, $post) {
                $imagePath = $post->image; // giữ ảnh cũ nếu không có ảnh mới

                if ($request->hasFile('image')) {
                    // Xóa ảnh cũ nếu có ảnh mới
                    if ($post->image) {
                        Storage::disk('public')->delete($post->image);
                    }
                    $imagePath = $request->file('image')->store('images', 'public');
                }

                $post->update([
                    'category_id' => $request->category_id,
                    'title' => $request->title,
                    'image' => $imagePath,
                    'content' => $request->content,
                ]);

                // Cập nhật bảng trung gian nếu cần
                $post->users()->sync([auth()->id()]);
            });

            return redirect()->route('posts.index')->with('success', 'Cập nhật bản tin thành công.');
        } catch (Exception $e) {
            Log::error(($e instanceof QueryException ? 'Database query error: ' : 'Unexpected error: ') . $e->getMessage());

            return redirect()
                ->route('posts.index')
                ->with('error', $e instanceof QueryException ? 'Failed to update post.' : 'An unexpected error occurred.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try {
            DB::transaction(function () use ($post) {

                // Xóa các bản ghi trong bảng trung gian
                $post->users()->detach();

                $post->delete();

            });

            return redirect()
                ->route('posts.index')
                ->with('success', 'Xóa bản tin thành công');

        } catch (Exception $e) {
            Log::error(($e instanceof QueryException ? 'Database query error: ' : 'Unexpected error: ') . $e->getMessage());

            return redirect()
                ->route('posts.index')
                ->with('error', $e instanceof QueryException ? 'Failed to delete post.' : 'An unexpected error occurred.');
        }
    }
}

