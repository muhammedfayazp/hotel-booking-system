<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Services\SearchService;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function __construct(protected SearchService $searchService) {}

    public function index(): View
    {
        return view('search.index');
    }

    public function search(SearchRequest $request): View
    {
        $results = $this->searchService->search($request->validated());

        return view('search.results', [
            'results'       => $results,
            'checkin_date'  => $request->checkin_date,
            'checkout_date' => $request->checkout_date,
            'guests'        => $request->guests,
            'city'          => $request->city,
        ]);
    }
}
