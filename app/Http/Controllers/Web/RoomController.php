<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\StoreRoomRequest;
use App\Models\Hotel;
use App\Services\RoomService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoomController extends Controller
{
    public function __construct(protected RoomService $roomService) {}

    public function index(): View
    {
        $rooms  = $this->roomService->allRoomsWithHotel();
        $hotels = Hotel::orderBy('name')->get();

        return view('rooms.index', compact('rooms', 'hotels'));
    }

    public function store(StoreRoomRequest $request): RedirectResponse
    {
        $this->roomService->createRoom($request->validated());

        return redirect()->route('rooms.index')->with('success', 'Room created successfully!');
    }
}
