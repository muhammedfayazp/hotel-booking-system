<?php

namespace App\Repositories;

use App\Models\Hotel;
use App\Repositories\Interfaces\HotelRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class HotelRepository implements HotelRepositoryInterface
{
    public function __construct(protected Hotel $model) {}

    public function create(array $data): Hotel
    {
        return $this->model->create($data);
    }

    public function findById(int $id): ?Hotel
    {
        return $this->model->with('rooms')->find($id);
    }

    public function paginate(array $filters, int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->byCity($filters['city'] ?? null)
            ->byRating($filters['rating'] ?? null)
            ->withCount('rooms')
            ->orderBy('name')
            ->paginate($perPage);
    }

    public function searchAvailable(array $filters): Collection
    {
        $guests = $filters['guests'] ?? 1;

        return $this->model
            ->byCity($filters['city'] ?? null)
            ->with([
                'rooms' => function ($q) use ($guests) {
                    $q->available()->forGuests($guests)->orderBy('price_per_night');
                },
            ])
            ->get()
            ->filter(fn (Hotel $h) => $h->rooms->isNotEmpty())
            ->values();
    }

    public function stats(): array
    {
        return [
            'total_hotels'   => $this->model->count(),
            'cities_covered' => $this->model->distinct('city')->count('city'),
            'avg_rating'     => round($this->model->avg('rating'), 1),
        ];
    }
}
