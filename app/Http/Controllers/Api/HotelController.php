<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\StoreHotelRequest;
use App\Http\Resources\Hotel\HotelResource;
use App\Services\HotelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HotelController extends Controller
{
    public function __construct(protected HotelService $hotelService) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        $hotels = $this->hotelService->listHotels(
            $request->only('city', 'rating'),
            (int) $request->get('per_page', 15),
        );

        return HotelResource::collection($hotels);
    }

    public function store(StoreHotelRequest $request): JsonResponse
    {
        $hotel = $this->hotelService->createHotel($request->validated());

        return (new HotelResource($hotel))
            ->response()
            ->setStatusCode(201);
    }
}
