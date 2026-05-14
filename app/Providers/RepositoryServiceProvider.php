<?php

namespace App\Providers;

use App\Repositories\HotelRepository;
use App\Repositories\Interfaces\HotelRepositoryInterface;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use App\Repositories\RoomRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(HotelRepositoryInterface::class, HotelRepository::class);
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
    }
}
