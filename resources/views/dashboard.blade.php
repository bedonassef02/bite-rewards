<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">Welcome, Shop Owner!</h3>
                    
                    @if(Auth::user()->shops()->count() > 0)
                        <!-- Stats Row -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <div class="p-6 bg-orange-50 rounded-2xl border border-orange-100">
                                <p class="text-sm text-gray-500 font-bold uppercase tracking-wide">Total Visits</p>
                                <p class="text-3xl font-extrabold text-brand mt-2">{{ $stats['total_visits'] }}</p>
                            </div>
                            <div class="p-6 bg-blue-50 rounded-2xl border border-blue-100">
                                <p class="text-sm text-gray-500 font-bold uppercase tracking-wide">Rewards Issued</p>
                                <p class="text-3xl font-extrabold text-blue-600 mt-2">{{ $stats['total_rewards'] }}</p>
                            </div>
                            <div class="p-6 bg-green-50 rounded-2xl border border-green-100">
                                <p class="text-sm text-gray-500 font-bold uppercase tracking-wide">Active Customers</p>
                                <p class="text-3xl font-extrabold text-green-600 mt-2">{{ $shop->visits()->distinct('user_id')->count() }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Scanner Card -->
                            <div class="p-8 bg-white rounded-3xl border border-gray-100 hover:shadow-lg transition duration-300">
                                <div class="w-12 h-12 bg-brand text-white rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4h2v-4zM6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <h4 class="font-bold text-xl text-gray-900 mb-2">Scan Customer QR</h4>
                                <p class="text-gray-600 mb-6">Ready to record a visit? Open the scanner to snap a customer's code.</p>
                                <a href="{{ route('shops.scan') }}" class="inline-flex items-center px-6 py-3 bg-brand border border-transparent rounded-full font-bold text-white hover:bg-orange-600 transition shadow-lg shadow-orange-200">
                                    Open Scanner
                                </a>
                            </div>
                            
                            <!-- Shop Details Card -->
                            <div class="p-8 bg-gray-50 rounded-3xl border border-gray-100 hover:shadow-lg transition duration-300">
                                <div class="flex justify-between items-start">
                                    <div class="w-12 h-12 bg-gray-800 text-white rounded-xl flex items-center justify-center mb-4">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    </div>
                                    <a href="{{ route('shops.edit', $shop) }}" class="text-sm font-bold text-gray-500 hover:text-brand">Edit Shop</a>
                                </div>
                                <h4 class="font-bold text-xl text-gray-900 mb-2">{{ $shop->name }}</h4>
                                <p class="text-gray-600 mb-1 font-semibold">Reward: {{ $shop->reward_name ?? 'Free Reward' }}</p>
                                <p class="text-sm text-gray-500">Visits Required: {{ $shop->visits_required }}</p>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-12 bg-gray-50 rounded-3xl border border-dashed border-gray-300">
                            <p class="mb-6 text-gray-500 text-lg">You haven't registered a shop yet.</p>
                            <a href="{{ route('shops.create') }}" class="inline-flex items-center px-8 py-4 bg-brand border border-transparent rounded-full font-bold text-white hover:bg-orange-600 transition shadow-lg shadow-orange-200">
                                Register Your Shop
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
