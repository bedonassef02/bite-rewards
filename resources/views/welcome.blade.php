<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Bite Rewards') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-white text-gray-900 font-sans selection:bg-brand selection:text-white">
        
        <!-- Navigation -->
        <nav class="flex items-center justify-between px-8 py-6 max-w-7xl mx-auto">
            <div class="flex items-center">
                <a href="/" class="text-3xl font-bold text-brand tracking-tight">Bite Rewards</a>
            </div>
            <div class="flex items-center space-x-6">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-brand transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-brand transition">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-2.5 bg-brand text-white rounded-full hover:bg-orange-600 transition font-bold shadow-lg shadow-orange-200">Get Started</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-24 lg:pt-32">
                <div class="text-center">
                    <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-gray-900 mb-8">
                        Loyalty programs <br/>
                        <span class="text-brand">reimagined.</span>
                    </h1>
                    <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500 mb-10">
                        Connect shops and customers seamlessly. No plastic cards, just QR codes. Simple, elegant, and rewarding.
                    </p>
                    <div class="flex justify-center gap-4">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-brand text-white rounded-full font-bold text-lg hover:bg-orange-600 transition shadow-xl shadow-orange-200 transform hover:-translate-y-1">
                            Join Now
                        </a>
                        <a href="#features" class="px-8 py-4 bg-gray-100 text-gray-700 rounded-full font-bold text-lg hover:bg-gray-200 transition">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div id="features" class="py-24 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                    <!-- Shop Owner Card -->
                    <div class="bg-white p-10 rounded-3xl shadow-xl hover:shadow-2xl transition duration-300 border border-gray-100">
                        <div class="w-16 h-16 bg-orange-100 rounded-2xl flex items-center justify-center mb-6 text-brand">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4">For Shop Owners</h3>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Create your shop profile, set your reward milestones, and use our built-in QR scanner to track customer visits instantly.
                        </p>
                        <ul class="space-y-3 text-gray-500">
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Easy Setup</li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Real-time Stats</li>
                        </ul>
                    </div>

                    <!-- Customer Card -->
                    <div class="bg-white p-10 rounded-3xl shadow-xl hover:shadow-2xl transition duration-300 border border-gray-100">
                        <div class="w-16 h-16 bg-orange-100 rounded-2xl flex items-center justify-center mb-6 text-brand">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4h2v-4zM6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4">For Customers</h3>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Discover new places, track your progress, and earn free meals. Your personal QR code is all you need.
                        </p>
                        <ul class="space-y-3 text-gray-500">
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> One Code for All</li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Free Rewards</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-100 py-12">
            <div class="max-w-7xl mx-auto px-4 text-center text-gray-400">
                &copy; {{ date('Y') }} Bite Rewards. Crafted with <span class="text-red-500">&hearts;</span>
            </div>
        </footer>
    </body>
</html>
