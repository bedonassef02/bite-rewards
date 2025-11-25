<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Bite Rewards') }} - Digital Loyalty Reimagined</title>
        <meta name="description" content="Modern loyalty rewards platform connecting shops and customers through QR codes. No cards, just rewards.">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-white text-gray-900 font-sans selection:bg-brand selection:text-white">
        
        <!-- Navigation -->
        <nav class="flex items-center justify-between px-8 py-6 max-w-7xl mx-auto sticky top-0 bg-white/80 backdrop-blur-md z-50 border-b border-gray-100">
            <div class="flex items-center">
                <a href="/" class="text-3xl font-bold text-brand tracking-tight">🍽️ Bite Rewards</a>
            </div>
            <div class="flex items-center space-x-6">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-brand transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-brand transition">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-2.5 bg-brand text-white rounded-full hover:bg-orange-600 transition font-bold shadow-lg shadow-orange-200 hover:shadow-xl hover:-translate-y-0.5 transform">Get Started</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative overflow-hidden bg-gradient-to-b from-orange-50 to-white">
            <!-- Background decoration -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute -top-40 -right-40 w-80 h-80 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
                <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-orange-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse" style="animation-delay: 2s;"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-32 lg:pt-32">
                <div class="text-center">
                    <!-- Badge -->
                    <div class="inline-flex items-center px-4 py-2 bg-orange-100 text-brand rounded-full text-sm font-semibold mb-8">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        No cards. No hassle. Just rewards.
                    </div>

                    <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-gray-900 mb-8">
                        Loyalty programs <br/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-orange-600">reimagined.</span>
                    </h1>
                    <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-600 mb-10 leading-relaxed">
                        Connect shops and customers seamlessly with QR code technology. 
                        <span class="font-semibold text-gray-900">Simple, elegant, and rewarding.</span>
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-brand text-white rounded-full font-bold text-lg hover:bg-orange-600 transition shadow-xl shadow-orange-200 transform hover:-translate-y-1 hover:shadow-2xl">
                            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Start Free Today
                        </a>
                        <a href="#features" class="px-8 py-4 bg-white text-gray-700 rounded-full font-bold text-lg hover:bg-gray-50 transition border-2 border-gray-200 hover:border-gray-300">
                            Learn More
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="mt-16 grid grid-cols-3 gap-8 max-w-3xl mx-auto">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-brand mb-2">100%</div>
                            <div class="text-sm text-gray-600">Digital</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-brand mb-2">0</div>
                            <div class="text-sm text-gray-600">Setup Fees</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-brand mb-2">∞</div>
                            <div class="text-sm text-gray-600">Possibilities</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div id="features" class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Built for Everyone</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        Whether you own a shop or love discovering new places, we've got you covered.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <!-- Shop Owner Card -->
                    <div class="bg-gradient-to-br from-orange-50 to-white p-10 rounded-3xl shadow-xl hover:shadow-2xl transition duration-300 border border-orange-100 group">
                        <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center mb-6 text-white shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-900">For Shop Owners</h3>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Create your shop profile, set reward milestones, and track customer visits with our built-in QR scanner. Grow your business with customer loyalty.
                        </p>
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> <span>Easy 5-minute setup</span></li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> <span>Real-time analytics dashboard</span></li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> <span>Premium featured listings</span></li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> <span>Customer retention tools</span></li>
                        </ul>
                    </div>

                    <!-- Customer Card -->
                    <div class="bg-gradient-to-br from-blue-50 to-white p-10 rounded-3xl shadow-xl hover:shadow-2xl transition duration-300 border border-blue-100 group">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center mb-6 text-white shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4h2v-4zM6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-900">For Customers</h3>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Discover amazing local shops, track your loyalty progress, and earn free rewards. One QR code for all your favorite places.
                        </p>
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> <span>One QR code for all shops</span></li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> <span>Track rewards in real-time</span></li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> <span>Discover new local spots</span></li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> <span>Earn free meals & treats</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="py-24 bg-gradient-to-r from-orange-500 to-orange-600">
            <div class="max-w-4xl mx-auto text-center px-4">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Ready to get started?
                </h2>
                <p class="text-xl text-orange-100 mb-10">
                    Join hundreds of shops and thousands of happy customers today.
                </p>
                <a href="{{ route('register') }}" class="inline-block px-10 py-5 bg-white text-brand rounded-full font-bold text-lg hover:bg-gray-100 transition shadow-2xl transform hover:-translate-y-1">
                    Create Your Free Account
                    <svg class="w-5 h-5 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-400 py-12">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center">
                    <div class="text-2xl font-bold text-white mb-4">🍽️ Bite Rewards</div>
                    <p class="mb-6">Digital loyalty, reimagined.</p>
                    <div class="flex justify-center space-x-6 mb-8">
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="hover:text-white transition">Login</a>
                            <a href="{{ route('register') }}" class="hover:text-white transition">Sign Up</a>
                        @endif
                    </div>
                    <div class="border-t border-gray-800 pt-8">
                        &copy; {{ date('Y') }} Bite Rewards. Crafted with <span class="text-red-500">&hearts;</span>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
