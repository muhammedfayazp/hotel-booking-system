@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 to-blue-700 flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden">

        <!-- Header -->
        <div class="bg-blue-600 px-8 py-8 text-center">
            <div class="text-5xl mb-3">🏨</div>
            <h1 class="text-white text-2xl font-bold">Hotel Booking System</h1>
            <p class="text-blue-100 text-sm mt-1">Sign in to your account</p>
        </div>

        <!-- Form -->
        <div class="px-8 py-8">
            <form action="{{ route('login.post') }}" method="POST" novalidate>
                @csrf

                <!-- Email -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Email Address</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="admin@example.com"
                        class="w-full px-4 py-2.5 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500
                        {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}"
                    >
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                    <input
                        type="password"
                        name="password"
                        placeholder="••••••••"
                        class="w-full px-4 py-2.5 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500
                        {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}"
                    >
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember -->
                <div class="mb-6 flex items-center gap-2">
                    <input type="checkbox" id="remember" name="remember" class="rounded">
                    <label for="remember" class="text-sm text-slate-600">Remember me</label>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition">
                    Sign In
                </button>
            </form>

            <p class="text-center text-slate-400 text-xs mt-6">
                Demo: <strong>admin@example.com</strong> / <strong>password</strong>
            </p>
        </div>
    </div>
</div>
@endsection
