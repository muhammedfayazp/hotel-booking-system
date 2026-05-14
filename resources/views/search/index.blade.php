@extends('layouts.app')

@section('title', 'Search Availability')
@section('page-title', 'Search Availability')

@section('content')
<div class="flex justify-center">
    <div class="w-full max-w-2xl">
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

            <div class="bg-yellow-400 px-8 py-6 text-center">
                <h5 class="text-xl font-bold text-yellow-900">🔍 Find Available Hotels</h5>
                <p class="text-yellow-800 text-sm mt-1">Search by city, dates and number of guests</p>
            </div>

            <div class="p-8">
                <form action="{{ route('search.results') }}" method="GET" novalidate>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Destination City</label>
                        <input type="text" name="city" value="{{ old('city') }}"
                            placeholder="e.g. Dubai"
                            class="w-full px-4 py-3 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400 {{ $errors->has('city') ? 'border-red-400' : 'border-slate-300' }}">
                        @error('city')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Check-in Date</label>
                            <input type="date" name="checkin_date" value="{{ old('checkin_date') }}"
                                min="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-3 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400 {{ $errors->has('checkin_date') ? 'border-red-400' : 'border-slate-300' }}">
                            @error('checkin_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Check-out Date</label>
                            <input type="date" name="checkout_date" value="{{ old('checkout_date') }}"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                class="w-full px-4 py-3 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400 {{ $errors->has('checkout_date') ? 'border-red-400' : 'border-slate-300' }}">
                            @error('checkout_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Number of Guests</label>
                        <input type="number" name="guests" value="{{ old('guests', 2) }}"
                            min="1" max="20"
                            class="w-full px-4 py-3 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400 {{ $errors->has('guests') ? 'border-red-400' : 'border-slate-300' }}">
                        @error('guests')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-yellow-400 hover:bg-yellow-500 text-yellow-900 font-bold py-3 rounded-lg transition text-sm">
                        🔍 Search Availability
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelector('[name="checkin_date"]')?.addEventListener('change', function() {
    const co = document.querySelector('[name="checkout_date"]');
    const next = new Date(this.value);
    next.setDate(next.getDate() + 1);
    co.min = next.toISOString().split('T')[0];
    if (!co.value || co.value <= this.value) {
        co.value = next.toISOString().split('T')[0];
    }
});
</script>
@endpush
