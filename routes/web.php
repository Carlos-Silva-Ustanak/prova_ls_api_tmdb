<?php

use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TvShowController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\NotAdmin;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;

Route::get('/', function () {
    return view('movies.index');
});

// Admin Routes
Route::middleware(['auth', Admin::class])->group(function () {
    Route::get('/admin/dashboard', [UserController::class, 'index'])->name('admin.dashboard');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Authenticated Routes (for verified users, excluding admins)
Route::middleware(['auth', 'verified', NotAdmin::class])->group(function () {
    Route::get('/dashboard', [MovieController::class, 'index'])->name('dashboard');
    Route::get('/movie/{id}', [MovieController::class, 'show'])->name('movie.show');
    Route::get('/search', [MovieController::class, 'search'])->name('movie.search');

    Route::get('/tv', [TvShowController::class, 'index'])->name('tv.index');
    Route::get('/tv/{id}', [TvShowController::class, 'show'])->name('tv.show');
    Route::get('/tv/popular', [TvShowController::class, 'more'])->name('tv.more');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes for loading more movies by category
    Route::get('/movies/more/{category}', [MovieController::class, 'more'])->name('movies.more');
    Route::get('/movies/more/{category}/page/{page}', [MovieController::class, 'more'])->name('movies.more.page');
});

// Redirect authenticated users away from login/register pages
Route::middleware(['auth', RedirectIfAuthenticated::class])->group(function () {
    // No need to duplicate the dashboard route here
    Route::get('/search', [MovieController::class, 'search'])->name('movie.search');
});

// Include authentication routes
require __DIR__ . '/auth.php';
