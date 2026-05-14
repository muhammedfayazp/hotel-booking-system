<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\HotelService;
use App\Services\RoomService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        protected HotelService $hotelService,
        protected RoomService  $roomService,
    ) {}

    public function index(): View
    {
        $stats = array_merge(
            $this->hotelService->getStats(),
            ['total_rooms' => $this->roomService->totalRooms()],
        );

        return view('dashboard.index', compact('stats'));
    }
}
