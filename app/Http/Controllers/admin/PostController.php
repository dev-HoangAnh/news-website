<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $images = [];

        try {
            DB::transaction(function () use ($request, &$images) {
                Post::create([
                    'user_id' => auth()->id(),
                    'category_id' => $request->category_id,
                    'title' => $request->title,
                    'image' => $request->image ? $request->file('image')->store('images', 'public') : null,
                    'content' => $request->content,
                ]);
            });

            return redirect()
                ->route('admin.posts.index')
                ->with('success', 'Thêm bản tin thành công.');

        } catch (QueryException $e) {
            Log::error('Database query error: ' . $e->getMessage());

            return redirect()
                ->route('admin.posts.index')
                ->with('error', 'Failed to create post.');

        } catch (Exception $e) {
            Log::error('Unexpected error: ' . $e->getMessage());

            return redirect()
                ->route('admin.posts.index')
                ->with('error', 'An unexpected error occurred.');
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
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
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

        } catch (QueryException $e) {
            Log::error('Database query error: ' . $e->getMessage());

            return redirect()
                ->route('posts.index')
                ->with('error', 'Failed to delete post.');

        } catch (Exception $e) {
            Log::error('Unexpected error: ' . $e->getMessage());

            return redirect()
                ->route('posts.index')
                ->with('error', 'An unexpected error occurred.');
        }
    }
}

