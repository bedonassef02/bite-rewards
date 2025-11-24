<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $shop->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="text-lg mb-4">{{ $shop->description }}</p>
                    
                    <div class="mt-8 p-6 bg-gray-50 dark:bg-gray-700 rounded-xl">
                        <h3 class="text-2xl font-bold text-center mb-2">Your Loyalty Progress</h3>
                        <p class="text-center text-gray-500 dark:text-gray-400 mb-6">
                            You have visited <span class="font-bold text-indigo-600 dark:text-indigo-400 text-xl">{{ $visitCount }}</span> times.
                            Reward at {{ $shop->visits_required }} visits.
                        </p>

                        <!-- Progress Bar -->
                        <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-6 mb-4 relative overflow-hidden">
                            <div class="bg-indigo-600 h-6 rounded-full transition-all duration-1000 ease-out" style="width: {{ $progress }}%"></div>
                            <div class="absolute inset-0 flex items-center justify-center text-xs font-bold text-white drop-shadow-md">
                                {{ round($progress) }}%
                            </div>
                        </div>

                        @if($progress >= 100 || ($visitCount > 0 && $visitCount % $shop->visits_required == 0))
                            <div class="text-center mt-4 p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg animate-bounce">
                                🎉 You've earned a free meal! Show your QR code to redeem.
                            </div>
                        @endif
                    </div>

                    <div class="mt-8 text-center">
                        <h4 class="text-lg font-semibold mb-4">Ready to collect a stamp?</h4>
                        <a href="{{ route('customer.qr') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg transform hover:scale-105">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4h2v-4zM6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Show My QR Code
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
