<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(['posts', 'postLinks', 'comments'])->latest('id')->paginate(5);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $request->role ?? 'client',
                ]);
            });

            return redirect()
                ->route('users.index')
                ->with('success', 'Thêm mới người dùng thành công.');

        } catch (QueryException $e) {

            // Log the error or handle it as needed
            Log::error('Database query error: ' . $e->getMessage());

            return redirect()
                ->route('users.index')
                ->with('error', 'Failed to create user.');

        } catch (Exception $e) {

            // Handle general errors
            Log::error('Unexpected error: ' . $e->getMessage());

            return redirect()
                ->route('users.index')
                ->with('error', 'An unexpected error occurred.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            DB::transaction(function () use ($request, $user) {
                $user->update([
                    'name' => $request->name,
                    'role' => $request->role ?? $user->role,
                ]);
            });

            return redirect()
                ->route('users.index')
                ->with('success', 'Cập nhật người dùng thành công.');

        } catch (QueryException $e) {
            // Log the error or handle it as needed
            Log::error('Database query error: ' . $e->getMessage());

            return redirect()
                ->route('users.index')
                ->with('error', 'Failed to update user.');

        } catch (Exception $e) {
            // Handle general errors
            Log::error('Unexpected error: ' . $e->getMessage());

            return redirect()
                ->route('users.index')
                ->with('error', 'An unexpected error occurred.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            DB::transaction(function () use ($user) {

                // Xóa các bản ghi trong bảng trung gian
                $user->postLinks()->detach();

                // Xóa tất cả các bài post của người dùng
                $user->posts()->delete();

                // Xóa user
                $user->delete();

            });

            return redirect()
                ->route('users.index')
                ->with('success', 'Xóa tài khoản người dùng thành công');

        } catch (QueryException $e) {
            // Log the error or handle it as needed
            Log::error('Database query error: ' . $e->getMessage());

            return redirect()
                ->route('users.index')
                ->with('error', 'Failed to delete user.');

        } catch (Exception $e) {
            // Handle general errors
            Log::error('Unexpected error: ' . $e->getMessage());

            return redirect()
                ->route('users.index')
                ->with('error', 'An unexpected error occurred.');
        }
    }
}

