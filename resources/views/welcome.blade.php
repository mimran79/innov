<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'InnovShop') }}</title>
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">        
        <link rel="manifest" href="/site.webmanifest">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 text-gray-900 antialiased">
        <!-- Navigation Bar -->
<!-- Navigation Bar -->
        <header x-data="{ mobileMenuOpen: false }" class="bg-white border-b border-gray-200 px-4 sm:px-8 py-4 shadow-sm relative">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex w-32 sm:w-40 h-auto">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('innovshop-logo-dark.png') }}" alt="InnovShop" class="w-full h-auto">
                </div>
                
                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex space-x-6 items-center">
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Home</a>
                    <a href="{{ url('/catalog') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Catalog</a>
                    @auth
                        @if(auth()->user()->role === 'client')
                        <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Cart</a>
                        @endif
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-indigo-600 font-medium">
                                Logout
                            </button>
                        </form>
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
                    <form method="POST" action="{{ route('logout') }}" class="block px-3 py-2">
                        @csrf
                        <button type="submit" class="w-full text-start text-base font-medium text-gray-700 hover:text-indigo-600">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">Log in</a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium bg-indigo-600 text-white text-center hover:bg-indigo-700">Register</a>
                @endauth
            </div>
        </header>

<!-- Main Content -->
        <main class="max-w-7xl mx-auto px-6 py-10 space-y-16">
            <!-- Hero Section -->
            <div class="bg-indigo-900 text-white py-16 px-6 rounded-2xl text-center shadow-md">
                <h1 class="text-4xl font-extrabold mb-4">Welcome to InnovShop</h1>
                <p class="text-lg text-indigo-200 mb-6">Discover our latest products and exclusive featured items.</p>
                <a href="{{ url('/catalog') }}" class="bg-white text-indigo-900 font-semibold px-6 py-3 rounded-lg shadow hover:bg-gray-100 inline-block">Browse Catalog</a>
            </div>

            <!-- Featured Products Section (Tinted Background) -->
            <section class="bg-indigo-50/60 p-8 rounded-3xl border border-indigo-100">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 bg-indigo-100 px-3 py-1 rounded-full">Spotlight</span>
                        <h2 class="text-2xl font-bold text-gray-900 mt-2">Featured Products</h2>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Products -->
                    @foreach ($featuredProducts as $product)
                    <a href="/catalog/{{ $product->id }}">
                        <div class="bg-white p-5 rounded-2xl shadow-sm border border-indigo-100 hover:shadow-md transition">
                        <div class="relative">
                            <span class="absolute top-2 left-2 bg-indigo-600 text-white text-xs font-semibold px-2.5 py-1 rounded-md">Featured</span>
                            <img src="{{ asset('storage/'. $product->image) }}" alt="{{$product->name}}" class="w-70 h-50 object-cover rounded-xl mb-4 mx-auto">
                        </div>
                        <h3 class="font-semibold text-lg text-gray-800">{{$product->name}}</h3>
                        <p class="text-indigo-600 font-bold mt-2">€{{$product->price}}</p>
                    </div>
                    </a>
                    @endforeach
                </div>
            </section>

            <!-- Recent Products Section -->
            <section>
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Recent Products</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Products-->
                    @foreach ($recentProducts as $product )
                     <a href="/catalog/{{ $product->id }}">
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
                        <img src="{{ asset('storage/'. $product->image) }}" alt="{{$product->name}}" class="w-70 h-50 object-cover rounded-xl mb-4 mx-auto">
                         <h3 class="font-semibold text-lg text-gray-800">{{$product->name}}</h3>
                        <p class="text-indigo-600 font-bold mt-2">€{{$product->price}}</p>
                    </div>  
                    </a>
                    @endforeach
                </div>
            </section>
        </main>
    </body>
</html>