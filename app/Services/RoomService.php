<?php

namespace App\Services;

use App\Models\Room;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class RoomService
{
    public function __construct(protected RoomRepositoryInterface $roomRepo) {}

    public function createRoom(array $data): Room
    {
        return $this->roomRepo->create($data);
    }

    public function allRoomsWithHotel(): Collection
    {
        return $this->roomRepo->allWithHotel();
    }

    public function totalRooms(): int
    {
        return $this->roomRepo->totalCount();
    }
}
