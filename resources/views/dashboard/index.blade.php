@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

    <div class="rounded-2xl p-6 text-white flex items-center gap-4" style="background: linear-gradient(135deg,#1a56db,#3b82f6)">
        <div class="bg-white bg-opacity-25 rounded-xl p-3 text-3xl">🏨</div>
        <div>
            <p class="text-sm opacity-75">Total Hotels</p>
            <h2 class="text-3xl font-bold">{{ $stats['total_hotels'] }}</h2>
        </div>
    </div>

    <div class="rounded-2xl p-6 text-white flex items-center gap-4" style="background: linear-gradient(135deg,#059669,#34d399)">
        <div class="bg-white bg-opacity-25 rounded-xl p-3 text-3xl">🚪</div>
        <div>
            <p class="text-sm opacity-75">Total Rooms</p>
            <h2 class="text-3xl font-bold">{{ $stats['total_rooms'] }}</h2>
        </div>
    </div>

    <div class="rounded-2xl p-6 text-white flex items-center gap-4" style="background: linear-gradient(135deg,#7c3aed,#a78bfa)">
        <div class="bg-white bg-opacity-25 rounded-xl p-3 text-3xl">📍</div>
        <div>
            <p class="text-sm opacity-75">Cities</p>
            <h2 class="text-3xl font-bold">{{ $stats['cities_covered'] }}</h2>
        </div>
    </div>

    <div class="rounded-2xl p-6 text-white flex items-center gap-4" style="background: linear-gradient(135deg,#d97706,#fbbf24)">
        <div class="bg-white bg-opacity-25 rounded-xl p-3 text-3xl">⭐</div>
        <div>
            <p class="text-sm opacity-75">Avg Rating</p>
            <h2 class="text-3xl font-bold">{{ $stats['avg_rating'] }}</h2>
        </div>
    </div>

</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-5">

    <div class="bg-white rounded-2xl shadow-sm p-6 text-center">
        <div class="text-5xl mb-4">🏨</div>
        <h5 class="font-semibold text-slate-800 mb-2">Manage Hotels</h5>
        <p class="text-slate-500 text-sm mb-4">Add, view and filter hotels by city or rating.</p>
        <a href="{{ route('hotels.index') }}"
           class="inline-block px-5 py-2 border border-blue-500 text-blue-600 rounded-lg text-sm font-semibold hover:bg-blue-50 transition">
            Go to Hotels
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6 text-center">
        <div class="text-5xl mb-4">🚪</div>
        <h5 class="font-semibold text-slate-800 mb-2">Manage Rooms</h5>
        <p class="text-slate-500 text-sm mb-4">Add rooms, assign to hotels, set pricing.</p>
        <a href="{{ route('rooms.index') }}"
           class="inline-block px-5 py-2 border border-green-500 text-green-600 rounded-lg text-sm font-semibold hover:bg-green-50 transition">
            Go to Rooms
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6 text-center">
        <div class="text-5xl mb-4">🔍</div>
        <h5 class="font-semibold text-slate-800 mb-2">Search Availability</h5>
        <p class="text-slate-500 text-sm mb-4">Find available rooms by city, dates and guests.</p>
        <a href="{{ route('search.index') }}"
           class="inline-block px-5 py-2 border border-yellow-500 text-yellow-600 rounded-lg text-sm font-semibold hover:bg-yellow-50 transition">
            Search Now
        </a>
    </div>

</div>
@endsection
