<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Services\SearchService;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{
    public function __construct(protected SearchService $searchService) {}

    public function __invoke(SearchRequest $request): JsonResponse
    {
        $results = $this->searchService->search($request->validated());

        return response()->json([
            'data' => $results,
            'meta' => [
                'total_hotels'  => $results->count(),
                'city'          => $request->city,
                'checkin_date'  => $request->checkin_date,
                'checkout_date' => $request->checkout_date,
                'guests'        => (int) $request->guests,
            ],
        ]);
    }
}
