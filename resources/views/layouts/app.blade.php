<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ProxyFlow') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <div class="flex-shrink-0">
                            <a href="{{ route('home') }}" class="flex items-center">
                                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">PF</span>
                                </div>
                                <span class="ml-2 text-xl font-semibold text-gray-900">ProxyFlow</span>
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden md:ml-10 md:flex md:space-x-8">
                            <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-900 px-3 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'text-blue-600' : '' }}">
                                Home
                            </a>
                            <a href="{{ route('pricing') }}" class="text-gray-500 hover:text-gray-900 px-3 py-2 text-sm font-medium {{ request()->routeIs('pricing') ? 'text-blue-600' : '' }}">
                                Pricing
                            </a>
                            <a href="{{ route('faq') }}" class="text-gray-500 hover:text-gray-900 px-3 py-2 text-sm font-medium {{ request()->routeIs('faq') ? 'text-blue-600' : '' }}">
                                FAQ
                            </a>
                        </div>
                    </div>

                    <!-- Right side -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-900 px-3 py-2 text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-blue-600' : '' }}">
                                Dashboard
                            </a>
                            <a href="{{ route('domains.index') }}" class="text-gray-500 hover:text-gray-900 px-3 py-2 text-sm font-medium {{ request()->routeIs('domains.*') ? 'text-blue-600' : '' }}">
                                Domains
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-500 hover:text-gray-900 px-3 py-2 text-sm font-medium">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-900 px-3 py-2 text-sm font-medium">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                Sign Up
                            </a>
                        @endauth

                        <!-- Mobile menu button -->
                        <div class="md:hidden">
                            <button type="button" class="text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900" onclick="toggleMobileMenu()">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200">
                <div class="px-2 pt-2 pb-3 space-y-1 bg-white">
                    <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-medium text-gray-500 hover:text-gray-900">Home</a>
                    <a href="{{ route('pricing') }}" class="block px-3 py-2 text-base font-medium text-gray-500 hover:text-gray-900">Pricing</a>
                    <a href="{{ route('faq') }}" class="block px-3 py-2 text-base font-medium text-gray-500 hover:text-gray-900">FAQ</a>
                    @guest
                        <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-gray-500 hover:text-gray-900">Login</a>
                        <a href="{{ route('register') }}" class="block px-3 py-2 text-base font-medium text-blue-600 hover:text-blue-700">Sign Up</a>
                    @endguest
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 mt-20">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold text-sm">PF</span>
                            </div>
                            <span class="ml-2 text-xl font-semibold text-gray-900">ProxyFlow</span>
                        </div>
                        <p class="mt-4 text-gray-600 max-w-md">
                            Professional reverse proxy solutions for modern web applications. Scale your infrastructure with confidence.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase">Product</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="{{ route('pricing') }}" class="text-gray-600 hover:text-gray-900">Pricing</a></li>
                            <li><a href="{{ route('faq') }}" class="text-gray-600 hover:text-gray-900">FAQ</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-gray-900">Documentation</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase">Support</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-gray-900">Contact</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-gray-900">Help Center</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-gray-900">Status</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <p class="text-center text-gray-600">&copy; {{ date('Y') }} ProxyFlow. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    @livewireScripts
    
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>
</html>