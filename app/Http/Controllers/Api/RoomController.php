<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\StoreRoomRequest;
use App\Http\Resources\Hotel\RoomResource;
use App\Services\RoomService;
use Illuminate\Http\JsonResponse;

class RoomController extends Controller
{
    public function __construct(protected RoomService $roomService) {}

    public function store(StoreRoomRequest $request): JsonResponse
    {
        $room = $this->roomService->createRoom($request->validated());
        $room->load('hotel');

        return (new RoomResource($room))
            ->response()
            ->setStatusCode(201);
    }
}
