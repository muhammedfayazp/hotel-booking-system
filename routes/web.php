<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\HotelController;
use App\Http\Controllers\Web\RoomController;
use App\Http\Controllers\Web\SearchController;
use Illuminate\Support\Facades\Route;

// ── Auth ──────────────────────────────────────────────────────────────────────
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ── Protected ─────────────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    Route::get('/', fn () => redirect()->route('dashboard'));

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Hotels
    Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
    Route::post('/hotels', [HotelController::class, 'store'])->name('hotels.store');

    // Rooms
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');

    // Search
    Route::get('/search', [SearchController::class, 'index'])->name('search.index');
    Route::get('/search/results', [SearchController::class, 'search'])->name('search.results');
});
