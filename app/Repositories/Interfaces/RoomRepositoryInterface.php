<?php

namespace App\Repositories\Interfaces;

use App\Models\Room;
use Illuminate\Database\Eloquent\Collection;

interface RoomRepositoryInterface
{
    public function create(array $data): Room;

    public function findById(int $id): ?Room;

    public function allWithHotel(): Collection;

    public function totalCount(): int;
}
