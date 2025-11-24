<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ $shop->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-gray-100">
                <div class="p-10 text-gray-900">
                    <p class="text-xl text-gray-600 mb-10 leading-relaxed">{{ $shop->description }}</p>
                    
                    <div class="p-8 bg-gray-50 rounded-3xl border border-gray-100">
                        <h3 class="text-2xl font-bold text-center mb-2">Your Loyalty Progress</h3>
                        <p class="text-center text-gray-500 mb-8">
                            You have visited <span class="font-bold text-brand text-2xl mx-1">{{ $visitCount }}</span> times.
                            <br/>Reward at {{ $shop->visits_required }} visits.
                        </p>

                        <!-- Progress Bar -->
                        <div class="w-full bg-gray-200 rounded-full h-8 mb-6 relative overflow-hidden shadow-inner">
                            <div class="bg-brand h-8 rounded-full transition-all duration-1000 ease-out shadow-lg shadow-orange-200" style="width: {{ $progress }}%"></div>
                            <div class="absolute inset-0 flex items-center justify-center text-sm font-bold text-white drop-shadow-md">
                                {{ round($progress) }}%
                            </div>
                        </div>

                        @if($progress >= 100 || ($visitCount > 0 && $visitCount % $shop->visits_required == 0))
                            <div class="text-center mt-6 p-6 bg-green-50 text-green-800 rounded-2xl border border-green-100 animate-bounce shadow-sm">
                                <p class="font-bold text-lg">🎉 You've earned a free meal!</p>
                                <p class="text-sm">Show your QR code to redeem.</p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-10 text-center">
                        <h4 class="text-lg font-semibold mb-6 text-gray-400 uppercase tracking-widest text-xs">Action</h4>
                        <a href="{{ route('customer.qr') }}" class="inline-flex items-center px-10 py-5 bg-brand border border-transparent rounded-full font-bold text-xl text-white hover:bg-orange-600 transition shadow-xl shadow-orange-200 transform hover:-translate-y-1">
                            <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4h2v-4zM6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Show My QR Code
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
