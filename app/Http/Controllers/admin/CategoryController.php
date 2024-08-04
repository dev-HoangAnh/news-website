<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('posts')->latest('id')->paginate(5);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:100|unique:categories',
            ],
            [
                'name.unique' => 'Danh mục đã tồn tại.',
            ]
        );

        try {
            DB::transaction(function () use ($request) {

                Category::create($request->all());

            }, 3);

            return redirect()
                ->route('categories.index')
                ->with('success', 'Danh mục đã được thêm thành công.');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['name' => 'Danh mục đã tồn tại.'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {

        $request->validate(
            [
                'name' => 'required|string|max:100|unique:categories',
            ],
            [
                'name.unique' => 'Danh mục đã tồn tại.',
            ]
        );

        try {

            DB::transaction(function () use ($request, $category) {
                $category->update($request->only('name'));
            });

            return redirect()
                ->route('categories.index')
                ->with('success', 'Danh mục đã được cập nhật thành công.');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withErrors([
                    'update' => 'Đã xảy ra lỗi khi cập nhật danh mục.',
                    'name' => 'Danh mục đã tồn tại.'
                ])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index');
    }
}
