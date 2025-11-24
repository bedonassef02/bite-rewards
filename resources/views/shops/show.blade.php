<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-gray-900 text-white overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-orange-500 to-pink-600 opacity-90"></div>
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 flex flex-col items-center text-center">
            @if($shop->logo_path)
                <img src="{{ asset('storage/' . $shop->logo_path) }}" alt="{{ $shop->name }}" class="w-32 h-32 rounded-3xl object-cover border-4 border-white/20 shadow-2xl mb-6 backdrop-blur-sm">
            @else
                <div class="w-32 h-32 rounded-3xl border-4 border-white/20 shadow-2xl mb-6 bg-white/10 backdrop-blur-sm flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
            @endif
            
            <h1 class="text-4xl md:text-6xl font-black tracking-tight mb-4">{{ $shop->name }}</h1>
            <p class="text-lg md:text-xl text-white/90 max-w-2xl leading-relaxed">{{ $shop->description }}</p>
            
            <div class="mt-8 flex items-center space-x-2 bg-white/10 backdrop-blur-md px-6 py-3 rounded-full border border-white/20">
                <svg class="w-5 h-5 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                <span class="font-bold tracking-wide">Reward every {{ $shop->visits_required }} visits</span>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-10 pb-20">
        
        <!-- Progress Card -->
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 md:p-10 mb-10">
            <div class="flex flex-col md:flex-row items-center justify-between mb-8">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">Your Progress</h3>
                    <p class="text-gray-500">Keep visiting to earn your next reward!</p>
                </div>
                <div class="mt-4 md:mt-0 bg-orange-50 text-brand px-5 py-2 rounded-xl font-bold text-lg">
                    {{ $visitCount }} / {{ $shop->visits_required }} Visits
                </div>
            </div>

            <div class="relative pt-1">
                <div class="flex mb-2 items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-brand bg-orange-100">
                            {{ round($progress) }}% Completed
                        </span>
                    </div>
                </div>
                <div class="overflow-hidden h-6 mb-4 text-xs flex rounded-full bg-gray-100 shadow-inner">
                    <div style="width:{{ $progress }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-gradient-to-r from-orange-400 to-pink-500 transition-all duration-1000 ease-out"></div>
                </div>
            </div>

            @if($progress >= 100 || ($visitCount > 0 && $visitCount % $shop->visits_required == 0))
                <div class="mt-6 bg-gradient-to-r from-green-400 to-emerald-500 rounded-2xl p-1 shadow-lg animate-pulse">
                    <div class="bg-white rounded-xl p-6 text-center">
                        <h4 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-700 mb-2">🎉 Reward Unlocked!</h4>
                        <p class="text-gray-600">You've earned a free reward. Check below to redeem!</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Rewards & History Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <!-- Available Rewards -->
            <div>
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                    Available Rewards
                </h3>
                
                @if(count($rewards) > 0)
                    <div class="space-y-4">
                        @foreach($rewards as $reward)
                            <div class="bg-white border-2 border-dashed border-brand/30 rounded-2xl p-5 relative overflow-hidden group hover:border-brand transition-colors">
                                <div class="absolute top-0 right-0 bg-brand text-white text-xs font-bold px-3 py-1 rounded-bl-xl">FREE</div>
                                <div class="flex items-center space-x-4">
                                    @if($shop->reward_image_path)
                                        <img src="{{ asset('storage/' . $shop->reward_image_path) }}" alt="Reward" class="w-16 h-16 rounded-xl object-cover shadow-sm">
                                    @else
                                        <div class="w-16 h-16 rounded-xl bg-orange-50 flex items-center justify-center text-brand">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                                        </div>
                                    @endif
                                    <div>
                                        <h4 class="font-bold text-gray-900 text-lg">{{ $shop->reward_name ?? 'Mystery Reward' }}</h4>
                                        <p class="text-xs text-gray-500">Earned {{ $reward->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <button class="mt-4 w-full py-2 bg-gray-900 text-white rounded-xl font-bold text-sm hover:bg-brand transition-colors shadow-lg shadow-gray-200">
                                    Redeem Now
                                </button>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gray-50 rounded-2xl p-8 text-center border border-gray-100">
                        <p class="text-gray-500">No rewards available yet. Keep visiting!</p>
                    </div>
                @endif
            </div>

            <!-- Visit History -->
            <div>
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Recent Visits
                </h3>

                @if(count($history) > 0)
                    <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden shadow-sm">
                        <div class="divide-y divide-gray-100">
                            @foreach($history as $visit)
                                <div class="p-4 flex items-center justify-between hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 rounded-full bg-green-50 text-green-600 flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900 text-sm">Visit Recorded</p>
                                            <p class="text-xs text-gray-500">{{ $visit->visited_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-mono text-gray-400">{{ $visit->visited_at->format('h:i A') }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="bg-gray-50 rounded-2xl p-8 text-center border border-gray-100">
                        <p class="text-gray-500">No visits recorded yet.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Floating QR Action -->
        <div class="fixed bottom-8 right-8 z-50">
            <a href="{{ route('customer.qr') }}" class="flex items-center justify-center w-16 h-16 bg-brand text-white rounded-full shadow-2xl hover:bg-orange-600 hover:scale-110 transition-all duration-300 ring-4 ring-orange-200">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4h2v-4zM6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </a>
        </div>

    </div>
</x-app-layout>
