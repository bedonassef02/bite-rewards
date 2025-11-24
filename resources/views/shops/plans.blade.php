<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-orange-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="text-center mb-16">
                <h1 class="text-5xl font-extrabold text-gray-900 mb-4">
                    Choose Your <span class="text-brand">Plan</span>
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Upgrade to Premium and get your shop featured at the top of search results
                </p>
            </div>

            <!-- Pricing Cards -->
            <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                
                <!-- Basic Plan -->
                <div class="bg-white rounded-3xl shadow-lg border-2 border-gray-200 p-8 relative">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Basic</h3>
                        <div class="flex items-baseline justify-center">
                            <span class="text-5xl font-extrabold text-gray-900">Free</span>
                        </div>
                        <p class="text-gray-500 mt-2">Perfect for getting started</p>
                    </div>

                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-gray-700">List your shop on the platform</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-gray-700">QR code scanning</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-gray-700">Customer rewards tracking</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-gray-700">Basic analytics</span>
                        </li>
                    </ul>

                    @if(Auth::user()->shops()->first()?->plan === 'basic')
                        <button disabled class="w-full py-4 bg-gray-100 text-gray-500 rounded-xl font-bold cursor-not-allowed">
                            Current Plan
                        </button>
                    @else
                        <a href="{{ route('dashboard') }}" class="block w-full py-4 bg-gray-100 text-gray-700 rounded-xl font-bold text-center hover:bg-gray-200 transition">
                            View Dashboard
                        </a>
                    @endif
                </div>

                <!-- Premium Plan -->
                <div class="bg-gradient-to-br from-brand to-pink-600 rounded-3xl shadow-2xl border-2 border-brand p-8 relative transform md:scale-105">
                    <!-- Popular Badge -->
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <span class="bg-yellow-400 text-gray-900 text-xs font-bold px-4 py-1.5 rounded-full shadow-lg">
                            ⭐ MOST POPULAR
                        </span>
                    </div>

                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-white mb-2">Premium</h3>
                        <div class="flex items-baseline justify-center">
                            <span class="text-5xl font-extrabold text-white">$29</span>
                            <span class="text-white/80 ml-2">/month</span>
                        </div>
                        <p class="text-white/90 mt-2">Get featured and grow faster</p>
                    </div>

                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-yellow-300 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-white font-medium">Everything in Basic, plus:</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-yellow-300 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-white"><strong>Featured Badge</strong> on your shop</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-yellow-300 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-white"><strong>Top placement</strong> in search results</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-yellow-300 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-white">Enhanced shop card styling</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-yellow-300 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-white">Priority customer support</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-yellow-300 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-white">Advanced analytics & insights</span>
                        </li>
                    </ul>

                    @if(Auth::user()->shops()->first()?->plan === 'premium')
                        <button disabled class="w-full py-4 bg-white/20 text-white rounded-xl font-bold cursor-not-allowed backdrop-blur-sm">
                            Current Plan
                        </button>
                    @else
                        <form action="{{ route('shops.upgrade', Auth::user()->shops()->first()) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full py-4 bg-white text-brand rounded-xl font-bold hover:bg-gray-100 transition shadow-xl transform hover:scale-105">
                                Upgrade to Premium
                            </button>
                        </form>
                    @endif
                </div>

            </div>

            <!-- FAQ or Additional Info -->
            <div class="mt-16 text-center">
                <p class="text-gray-600">
                    Have questions? <a href="#" class="text-brand font-bold hover:underline">Contact our support team</a>
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
