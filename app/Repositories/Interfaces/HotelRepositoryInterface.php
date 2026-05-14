<?php

namespace App\Repositories\Interfaces;

use App\Models\Hotel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface HotelRepositoryInterface
{
    public function create(array $data): Hotel;

    public function findById(int $id): ?Hotel;

    public function paginate(array $filters, int $perPage = 15): LengthAwarePaginator;

    public function searchAvailable(array $filters): Collection;

    public function stats(): array;
}
