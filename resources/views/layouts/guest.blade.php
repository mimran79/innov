<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'InnovShop') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-slate-200">
<!-- Navigation Bar -->
        <header x-data="{ mobileMenuOpen: false }" class="bg-white border-b border-gray-200 px-4 sm:px-8 py-4 shadow-sm relative">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex w-32 sm:w-40 h-auto">
                    <img src="{{ asset('innovshop-logo-dark.png') }}" alt="InnovShop" class="w-full h-auto">
                </div>
                
                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex space-x-6 items-center">
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Home</a>
                    <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium">Catalog</a>
                    @auth
                        @if(auth()->user()->role === 'client')
                            <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium">Cart</a>
                        @endif
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Log in</a>
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Register</a>
                    @endauth
                </nav>

                <!-- Hamburger Button for Mobile -->
                <div class="flex items-center md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': mobileMenuOpen, 'inline-flex': !mobileMenuOpen}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !mobileMenuOpen, 'inline-flex': mobileMenuOpen}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Dropdown Menu -->
            <div x-show="mobileMenuOpen" class="md:hidden mt-4 pb-4 space-y-2 border-t border-gray-100 pt-3">
                <a href="{{ url('/') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">Home</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">Catalog</a>
                @auth
                    @if(auth()->user()->role === 'client')
                        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">Cart</a>
                    @endif
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">Log in</a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium bg-indigo-600 text-white text-center hover:bg-indigo-700">Register</a>
                @endauth
            </div>
        </header>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-4">
                <a href="/">
                    <x-application-logo-dark class="fill-current text-gray-100" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-xl overflow-hidden sm:rounded-lg border border-gray-300">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>