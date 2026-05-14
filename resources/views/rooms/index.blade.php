@extends('layouts.app')

@section('title', 'Rooms')
@section('page-title', 'Room Management')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Add Room Form -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="bg-green-600 px-5 py-4">
                <h6 class="text-white font-semibold">➕ Add New Room</h6>
            </div>
            <div class="p-5">
                <form action="{{ route('rooms.store') }}" method="POST" novalidate>
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Hotel</label>
                        <select name="hotel_id"
                            class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 {{ $errors->has('hotel_id') ? 'border-red-400' : 'border-slate-300' }}">
                            <option value="">Select hotel…</option>
                            @foreach ($hotels as $hotel)
                                <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                                    {{ $hotel->name }} ({{ $hotel->city }})
                                </option>
                            @endforeach
                        </select>
                        @error('hotel_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Room Name / Type</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            placeholder="e.g. Deluxe Sea View"
                            class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 {{ $errors->has('name') ? 'border-red-400' : 'border-slate-300' }}">
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Price per Night (USD)</label>
                        <div class="flex">
                            <span class="px-3 py-2 bg-slate-100 border border-r-0 border-slate-300 rounded-l-lg text-sm text-slate-500">$</span>
                            <input type="number" name="price_per_night" value="{{ old('price_per_night') }}"
                                placeholder="0.00" min="0" step="0.01"
                                class="flex-1 px-3 py-2 border rounded-r-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 {{ $errors->has('price_per_night') ? 'border-red-400' : 'border-slate-300' }}">
                        </div>
                        @error('price_per_night')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Max Occupancy</label>
                        <input type="number" name="max_occupancy" value="{{ old('max_occupancy') }}"
                            placeholder="2" min="1"
                            class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 {{ $errors->has('max_occupancy') ? 'border-red-400' : 'border-slate-300' }}">
                        @error('max_occupancy')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Available Rooms</label>
                        <input type="number" name="available_rooms" value="{{ old('available_rooms') }}"
                            placeholder="10" min="0"
                            class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 {{ $errors->has('available_rooms') ? 'border-red-400' : 'border-slate-300' }}">
                        @error('available_rooms')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2.5 rounded-lg transition text-sm">
                        💾 Save Room
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Rooms List -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100">
                <h6 class="font-semibold text-slate-800">
                    All Rooms
                    <span class="ml-2 bg-green-100 text-green-700 text-xs font-bold px-2 py-0.5 rounded-full">{{ $rooms->count() }}</span>
                </h6>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-xs uppercase text-slate-500 tracking-wide">
                        <tr>
                            <th class="px-5 py-3 text-left">#</th>
                            <th class="px-5 py-3 text-left">Room</th>
                            <th class="px-5 py-3 text-left">Hotel</th>
                            <th class="px-5 py-3 text-left">Price/Night</th>
                            <th class="px-5 py-3 text-left">Max Guests</th>
                            <th class="px-5 py-3 text-left">Available</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($rooms as $room)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-3 text-slate-400">{{ $room->id }}</td>
                            <td class="px-5 py-3 font-semibold text-slate-800">{{ $room->name }}</td>
                            <td class="px-5 py-3">
                                <span class="text-slate-700">{{ $room->hotel->name }}</span><br>
                                <span class="text-xs text-slate-400">{{ $room->hotel->city }}</span>
                            </td>
                            <td class="px-5 py-3 text-green-600 font-semibold">${{ number_format($room->price_per_night, 2) }}</td>
                            <td class="px-5 py-3 text-slate-600">👤 {{ $room->max_occupancy }}</td>
                            <td class="px-5 py-3">
                                @if ($room->available_rooms > 0)
                                    <span class="bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded-full font-medium">
                                        {{ $room->available_rooms }} left
                                    </span>
                                @else
                                    <span class="bg-red-100 text-red-700 text-xs px-2 py-0.5 rounded-full font-medium">
                                        Sold Out
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-slate-400 py-12">
                                <div class="text-4xl mb-2">🚪</div>
                                No rooms found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
