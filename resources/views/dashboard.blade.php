<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Welcome, Shop Owner!</h3>
                    
                    @if(Auth::user()->shops()->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-4 bg-indigo-50 dark:bg-indigo-900 rounded-lg border border-indigo-200 dark:border-indigo-700">
                                <h4 class="font-bold text-indigo-700 dark:text-indigo-300 mb-2">Scan Customer QR</h4>
                                <p class="text-sm mb-4">Scan a customer's QR code to record a visit.</p>
                                <a href="{{ route('shops.scan') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Open Scanner
                                </a>
                            </div>
                            
                            <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
                                <h4 class="font-bold text-gray-700 dark:text-gray-300 mb-2">Your Shop</h4>
                                <p class="text-sm mb-4">{{ Auth::user()->shops()->first()->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Visits Required: {{ Auth::user()->shops()->first()->visits_required }}</p>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="mb-4">You haven't registered a shop yet.</p>
                            <a href="{{ route('shops.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Register Your Shop
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
