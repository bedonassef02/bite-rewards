<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>404 - Page Not Found | {{ config('app.name', 'Bite Rewards') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gradient-to-br from-orange-50 via-white to-orange-50 text-gray-900 font-sans selection:bg-brand selection:text-white">
        <div class="min-h-screen flex flex-col items-center justify-center px-4">
            <!-- 404 Illustration -->
            <div class="text-center mb-8">
                <div class="inline-block relative">
                    <h1 class="text-[12rem] md:text-[16rem] font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600 leading-none">
                        404
                    </h1>
                    <div class="absolute inset-0 blur-3xl bg-gradient-to-r from-orange-200 to-orange-300 opacity-30 -z-10"></div>
                </div>
            </div>

            <!-- Message -->
            <div class="text-center max-w-2xl mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Oops! Page Not Found
                </h2>
                <p class="text-lg text-gray-600 mb-8">
                    The page you're looking for seems to have wandered off. Don't worry, even the best rewards are sometimes hard to find!
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 mb-16">
                <a href="{{ url('/') }}" class="px-8 py-4 bg-brand text-white rounded-full font-bold text-lg hover:bg-orange-600 transition shadow-xl shadow-orange-200 transform hover:-translate-y-1 text-center">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Go Home
                </a>
                @auth
                    <a href="{{ route('dashboard') }}" class="px-8 py-4 bg-gray-100 text-gray-700 rounded-full font-bold text-lg hover:bg-gray-200 transition text-center">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-8 py-4 bg-gray-100 text-gray-700 rounded-full font-bold text-lg hover:bg-gray-200 transition text-center">
                        Sign In
                    </a>
                @endauth
            </div>

            <!-- Fun Fact -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 max-w-md border border-orange-100 shadow-lg">
                <p class="text-sm text-gray-500 text-center">
                    <span class="font-semibold text-brand">💡 Did you know?</span><br>
                    You can earn rewards at all participating shops with just one QR code!
                </p>
            </div>
        </div>
    </body>
</html>
