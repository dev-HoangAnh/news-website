<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\auth\AdminController;
use App\Http\Controllers\auth\AuthenController;
use App\Http\Controllers\auth\ClientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthenController::class)
    ->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');
        Route::post('/logout', 'logout')->name('logout');
        Route::get('/register', 'showRegisterForm')->name('register');
        Route::post('/register', 'register');
    });

Route::middleware(['auth'])->group(function () {
    Route::get('cl', [ClientController::class, 'dashboard'])
        ->name('client.dashboard')
        ->middleware('is_Client');

    Route::middleware('is_Admin')
        ->prefix('ad')
        ->group(function () {
            Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

            Route::resource('categories',   CategoryController::class);
            Route::resource('posts',        PostController::class);
            Route::resource('users',        UserController::class);
            Route::resource('posts',        PostController::class);
        });
});


