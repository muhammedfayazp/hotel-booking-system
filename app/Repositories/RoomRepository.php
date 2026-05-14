<?php

namespace App\Repositories;

use App\Models\Room;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class RoomRepository implements RoomRepositoryInterface
{
    public function __construct(protected Room $model) {}

    public function create(array $data): Room
    {
        return $this->model->create($data);
    }

    public function findById(int $id): ?Room
    {
        return $this->model->with('hotel')->find($id);
    }

    public function allWithHotel(): Collection
    {
        return $this->model->with('hotel')->orderBy('hotel_id')->get();
    }

    public function totalCount(): int
    {
        return $this->model->count();
    }
}
