<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\StoreHotelRequest;
use App\Services\HotelService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HotelController extends Controller
{
    public function __construct(protected HotelService $hotelService) {}

    public function index(Request $request): View
    {
        $hotels = $this->hotelService->listHotels(
            $request->only('city', 'rating'),
            10,
        );

        return view('hotels.index', compact('hotels'));
    }

    public function store(StoreHotelRequest $request): RedirectResponse
    {
        $this->hotelService->createHotel($request->validated());

        return redirect()->route('hotels.index')->with('success', 'Hotel created successfully!');
    }
}
