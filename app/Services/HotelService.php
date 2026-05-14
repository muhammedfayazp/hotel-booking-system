<?php

namespace App\Services;

use App\Models\Hotel;
use App\Repositories\Interfaces\HotelRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class HotelService
{
    public function __construct(protected HotelRepositoryInterface $hotelRepo) {}

    public function createHotel(array $data): Hotel
    {
        return $this->hotelRepo->create($data);
    }

    public function listHotels(array $filters, int $perPage = 15): LengthAwarePaginator
    {
        return $this->hotelRepo->paginate($filters, $perPage);
    }

    public function getStats(): array
    {
        return $this->hotelRepo->stats();
    }
}
