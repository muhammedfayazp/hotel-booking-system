@extends('layouts.app')

@section('title', 'Search Results')
@section('page-title', 'Search Results')

@section('content')

<!-- Search Summary -->
<div class="bg-yellow-50 border border-yellow-200 rounded-2xl px-6 py-4 mb-6 flex flex-wrap gap-4 items-center">
    <div class="text-sm text-yellow-800">📍 <strong>{{ $city }}</strong></div>
    <div class="text-slate-300">|</div>
    <div class="text-sm text-yellow-800">📅 {{ $checkin_date }} → {{ $checkout_date }}</div>
    <div class="text-slate-300">|</div>
    <div class="text-sm text-yellow-800">👥 {{ $guests }} guest(s)</div>
    <div class="text-slate-300">|</div>
    <div class="text-sm text-slate-500">{{ $results->count() }} hotel(s) found</div>
    <a href="{{ route('search.index') }}"
        class="ml-auto text-sm px-4 py-1.5 border border-slate-300 text-slate-600 rounded-lg hover:bg-slate-50 transition">
        ← New Search
    </a>
</div>

@forelse ($results as $hotel)
<div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-5">

    <!-- Hotel Header -->
    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-4">
        <div class="bg-blue-100 rounded-xl p-3 text-2xl">🏨</div>
        <div>
            <h5 class="font-bold text-slate-800 text-lg">{{ $hotel['name'] }}</h5>
            <div class="text-sm text-slate-500">
                📍 {{ $hotel['city'] }}, {{ $hotel['country'] }}
                <span class="ml-2 bg-yellow-100 text-yellow-700 text-xs px-2 py-0.5 rounded-full font-medium">
                    {{ str_repeat('★', $hotel['rating']) }}
                </span>
            </div>
        </div>
        <div class="ml-auto text-right">
            <span class="bg-green-100 text-green-700 text-sm font-semibold px-3 py-1 rounded-full">
                {{ count($hotel['rooms']) }} room type(s)
            </span>
            <div class="text-xs text-slate-400 mt-1">{{ $hotel['nights'] }} night(s)</div>
        </div>
    </div>

    <!-- Rooms Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-xs uppercase text-slate-500 tracking-wide">
                <tr>
                    <th class="px-6 py-3 text-left">Room Type</th>
                    <th class="px-6 py-3 text-left">Max Guests</th>
                    <th class="px-6 py-3 text-left">Available</th>
                    <th class="px-6 py-3 text-left">Price / Night</th>
                    <th class="px-6 py-3 text-right">Total ({{ $hotel['nights'] }} nights)</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach ($hotel['rooms'] as $room)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 font-semibold text-slate-800">{{ $room['name'] }}</td>
                    <td class="px-6 py-4 text-slate-600">👤 {{ $room['max_occupancy'] }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded-full font-medium">
                            {{ $room['available_rooms'] }} left
                        </span>
                    </td>
                    <td class="px-6 py-4 text-slate-500">${{ number_format($room['price_per_night'], 2) }}</td>
                    <td class="px-6 py-4 text-right">
                        <span class="text-blue-600 font-bold text-lg">${{ number_format($room['total_price'], 2) }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@empty
<div class="bg-white rounded-2xl shadow-sm p-12 text-center">
    <div class="text-5xl mb-4">🏚️</div>
    <h5 class="text-slate-600 font-semibold text-lg">No available hotels found</h5>
    <p class="text-slate-400 text-sm mt-1">Try a different city, dates or fewer guests.</p>
    <a href="{{ route('search.index') }}"
        class="inline-block mt-4 px-6 py-2 bg-yellow-400 text-yellow-900 font-semibold rounded-lg hover:bg-yellow-500 transition">
        Try Again
    </a>
</div>
@endforelse

@endsection
