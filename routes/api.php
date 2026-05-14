<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\SearchController;
use Illuminate\Support\Facades\Route;

// ── Public endpoints ──────────────────────────────────────────────────────────
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:10,1')
    ->name('api.login');

// ── Sanctum-protected ─────────────────────────────────────────────────────────
Route::middleware(['auth:sanctum', 'throttle:api'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

    // Hotels
    Route::get('/hotels', [HotelController::class, 'index'])->name('api.hotels.index');
    Route::post('/hotels', [HotelController::class, 'store'])->name('api.hotels.store');

    // Rooms
    Route::post('/rooms', [RoomController::class, 'store'])->name('api.rooms.store');

    // Search
    Route::get('/search', SearchController::class)->name('api.search');
});
