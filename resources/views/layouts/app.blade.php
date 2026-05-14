<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Hotel Booking') – SkyUniTech</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 font-sans">

@auth
<!-- Sidebar -->
<div class="fixed top-0 left-0 h-screen w-60 bg-slate-900 z-50 flex flex-col">
    <div class="px-6 py-5 border-b border-slate-700">
        <span class="text-white font-bold text-lg flex items-center gap-2">
            🏨 HotelSystem
        </span>
    </div>
    <nav class="flex-1 py-4 space-y-1 px-3">
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm
           {{ request()->routeIs('dashboard') ? 'bg-slate-700 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            📊 Dashboard
        </a>
        <a href="{{ route('hotels.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm
           {{ request()->routeIs('hotels.*') ? 'bg-slate-700 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            🏨 Hotels
        </a>
        <a href="{{ route('rooms.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm
           {{ request()->routeIs('rooms.*') ? 'bg-slate-700 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            🚪 Rooms
        </a>
        <a href="{{ route('search.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm
           {{ request()->routeIs('search.*') ? 'bg-slate-700 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            🔍 Search
        </a>
    </nav>
    <div class="px-3 py-4 border-t border-slate-700">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-slate-400 hover:bg-slate-800 hover:text-white">
                🚪 Logout
            </button>
        </form>
    </div>
</div>
@endauth

<!-- Main -->
<div class="{{ auth()->check() ? 'ml-60' : '' }}">
    @auth
    <!-- Topbar -->
    <div class="bg-white h-16 border-b border-slate-200 flex items-center justify-between px-6 sticky top-0 z-40">
        <span class="font-semibold text-slate-800">@yield('page-title', 'Dashboard')</span>
        <span class="text-sm text-slate-500">👤 {{ auth()->user()->name }}</span>
    </div>
    @endauth

    <div class="{{ auth()->check() ? 'p-6' : '' }}">
        @if (session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                ✅ {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</div>

</body>
</html>
