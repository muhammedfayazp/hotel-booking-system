<?php

namespace App\Services;

use App\Repositories\Interfaces\HotelRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class SearchService
{
    private int $cacheTtl;

    public function __construct(protected HotelRepositoryInterface $hotelRepo)
    {
        $this->cacheTtl = (int) config('app.search_cache_ttl', 300);
    }

    public function search(array $params): Collection
    {
        $cacheKey = $this->buildCacheKey($params);

        return Cache::remember($cacheKey, $this->cacheTtl, function () use ($params) {
            $nights = $this->calculateNights($params['checkin_date'], $params['checkout_date']);

            $hotels = $this->hotelRepo->searchAvailable($params);

            return $hotels->map(function ($hotel) use ($nights) {
                $rooms = $hotel->rooms->map(function ($room) use ($nights) {
                    return [
                        'id'              => $room->id,
                        'name'            => $room->name,
                        'price_per_night' => (float) $room->price_per_night,
                        'max_occupancy'   => $room->max_occupancy,
                        'available_rooms' => $room->available_rooms,
                        'total_price'     => round((float) $room->price_per_night * $nights, 2),
                    ];
                });

                return [
                    'id'      => $hotel->id,
                    'name'    => $hotel->name,
                    'city'    => $hotel->city,
                    'country' => $hotel->country,
                    'rating'  => $hotel->rating,
                    'nights'  => $nights,
                    'rooms'   => $rooms,
                ];
            });
        });
    }

    private function calculateNights(string $checkin, string $checkout): int
    {
        $nights = Carbon::parse($checkin)->diffInDays(Carbon::parse($checkout));
        return max(1, (int) $nights);
    }

    private function buildCacheKey(array $params): string
    {
        ksort($params);
        return 'search:' . md5(json_encode($params));
    }
}
