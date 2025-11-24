<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            Shop Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-gray-100">
                <div class="p-10 text-gray-900">
                    <div class="flex items-center space-x-6 mb-8">
                        @if($shop->logo_path)
                            <img src="{{ asset('storage/' . $shop->logo_path) }}" alt="{{ $shop->name }}" class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg">
                        @endif
                        <div>
                             <h1 class="text-3xl font-bold text-gray-900">{{ $shop->name }}</h1>
                             <p class="text-gray-500 mt-1">Reward every {{ $shop->visits_required }} visits</p>
                        </div>
                    </div>

                    <p class="text-xl text-gray-600 mb-10 leading-relaxed">{{ $shop->description }}</p>
                    
                    <div class="p-8 bg-gray-50 rounded-3xl border border-gray-100 mb-10">
                        <h3 class="text-2xl font-bold text-center mb-2">Your Loyalty Progress</h3>
                        <p class="text-center text-gray-500 mb-8">
                            You have visited <span class="font-bold text-brand text-2xl mx-1">{{ $visitCount }}</span> times.
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
                                <p class="text-sm">Check your rewards below.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Rewards Section -->
                    @if(count($rewards) > 0)
                        <div class="mb-10">
                            <h3 class="text-2xl font-bold mb-6">Available Rewards</h3>
                            <div class="grid gap-4">
                                @foreach($rewards as $reward)
                                    <div class="p-6 bg-white border border-brand rounded-2xl shadow-sm flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            @if($shop->reward_image_path)
                                                <img src="{{ asset('storage/' . $shop->reward_image_path) }}" alt="Reward" class="w-12 h-12 rounded-lg object-cover">
                                            @endif
                                            <div>
                                                <p class="font-bold text-lg text-brand">{{ $shop->reward_name ?? 'Free Reward Available!' }}</p>
                                                <p class="text-sm text-gray-500">Earned on {{ $reward->created_at->format('M d, Y') }}</p>
                                            </div>
                                        </div>
                                        <button class="px-6 py-2 bg-brand text-white rounded-full font-bold text-sm hover:bg-orange-600 transition">
                                            Redeem
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- History Section -->
                    @if(count($history) > 0)
                        <div>
                            <h3 class="text-2xl font-bold mb-6">Visit History</h3>
                            <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-100">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-100">
                                        @foreach($history as $visit)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $visit->visited_at->format('M d, Y') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $visit->visited_at->format('h:i A') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

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
