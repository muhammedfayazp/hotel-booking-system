@extends('layouts.app')

@section('title', 'Hotels')
@section('page-title', 'Hotel Management')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Add Hotel Form -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="bg-blue-600 px-5 py-4">
                <h6 class="text-white font-semibold">➕ Add New Hotel</h6>
            </div>
            <div class="p-5">
                <form action="{{ route('hotels.store') }}" method="POST" novalidate>
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Hotel Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            placeholder="e.g. Grand Hyatt"
                            class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('name') ? 'border-red-400' : 'border-slate-300' }}">
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">City</label>
                        <input type="text" name="city" value="{{ old('city') }}"
                            placeholder="e.g. Dubai"
                            class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('city') ? 'border-red-400' : 'border-slate-300' }}">
                        @error('city')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Country</label>
                        <input type="text" name="country" value="{{ old('country') }}"
                            placeholder="e.g. UAE"
                            class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('country') ? 'border-red-400' : 'border-slate-300' }}">
                        @error('country')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Rating (1–5)</label>
                        <select name="rating"
                            class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('rating') ? 'border-red-400' : 'border-slate-300' }}">
                            <option value="">Select rating…</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                                    {{ str_repeat('★', $i) }}{{ str_repeat('☆', 5 - $i) }}
                                </option>
                            @endfor
                        </select>
                        @error('rating')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition text-sm">
                        💾 Save Hotel
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Hotels List -->
    <div class="lg:col-span-2">

        <!-- Filter Bar -->
        <div class="bg-white rounded-2xl shadow-sm p-4 mb-4">
            <form action="{{ route('hotels.index') }}" method="GET" class="flex flex-wrap gap-3 items-end">
                <div class="flex-1 min-w-36">
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Filter by City</label>
                    <input type="text" name="city" value="{{ request('city') }}"
                        placeholder="e.g. Dubai"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex-1 min-w-36">
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Filter by Rating</label>
                    <select name="rating" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Ratings</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>{{ $i }} ★</option>
                        @endfor
                    </select>
                </div>
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                        Filter
                    </button>
                    <a href="{{ route('hotels.index') }}"
                        class="px-4 py-2 border border-slate-300 text-slate-600 rounded-lg text-sm hover:bg-slate-50 transition">
                        Clear
                    </a>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                <h6 class="font-semibold text-slate-800">
                    Hotels
                    <span class="ml-2 bg-blue-100 text-blue-700 text-xs font-bold px-2 py-0.5 rounded-full">{{ $hotels->total() }}</span>
                </h6>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-xs uppercase text-slate-500 tracking-wide">
                        <tr>
                            <th class="px-5 py-3 text-left">#</th>
                            <th class="px-5 py-3 text-left">Hotel Name</th>
                            <th class="px-5 py-3 text-left">City</th>
                            <th class="px-5 py-3 text-left">Country</th>
                            <th class="px-5 py-3 text-left">Rating</th>
                            <th class="px-5 py-3 text-left">Rooms</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($hotels as $hotel)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-3 text-slate-400">{{ $hotel->id }}</td>
                            <td class="px-5 py-3 font-semibold text-slate-800">{{ $hotel->name }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $hotel->city }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $hotel->country }}</td>
                            <td class="px-5 py-3">
                                <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-0.5 rounded-full font-medium">
                                    {{ str_repeat('★', $hotel->rating) }}
                                </span>
                            </td>
                            <td class="px-5 py-3">
                                <span class="bg-slate-100 text-slate-700 text-xs px-2 py-0.5 rounded-full">
                                    {{ $hotel->rooms_count ?? '–' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-slate-400 py-12">
                                <div class="text-4xl mb-2">🏨</div>
                                No hotels found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($hotels->hasPages())
            <div class="px-5 py-4 border-t border-slate-100">
                {{ $hotels->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
