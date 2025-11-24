<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <!-- Header Section -->
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                    Discover <span class="text-brand">Rewards</span>
                </h2>
                <p class="mt-2 text-lg text-gray-500">Explore local shops and start earning free perks today.</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <!-- Search Bar -->
            <div class="mb-20 max-w-2xl mx-auto">
                <form action="{{ route('shops.index') }}" method="GET" class="relative group">
                    <input type="text" name="search" value="{{ request('search') }}" class="block w-full px-8 py-4 border-2 border-gray-100 rounded-full leading-5 bg-white placeholder-gray-400 focus:outline-none focus:bg-white focus:border-brand focus:ring-0 text-lg shadow-sm hover:shadow-md transition-all duration-200 text-center" placeholder="Search for shops...">
                    @if(request('search'))
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                            <a href="{{ route('shops.index') }}" class="p-1 rounded-full hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </a>
                        </div>
                    @endif
                </form>
            </div>

            @if($shops->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($shops as $shop)
                        <a href="{{ route('shops.show', $shop) }}" class="group block h-full transform hover:-translate-y-2 transition-all duration-300">
                            <div class="bg-white rounded-3xl shadow-sm hover:shadow-xl overflow-hidden border border-gray-100 h-full flex flex-col relative">
                                <!-- Card Header Gradient -->
                                <div class="h-32 bg-gradient-to-r from-orange-400 to-pink-500 relative">
                                    <div class="absolute inset-0 bg-black opacity-10 group-hover:opacity-0 transition duration-300"></div>
                                </div>
                                
                                <!-- Logo Wrapper -->
                                <div class="absolute top-20 left-8">
                                    @if($shop->logo_path)
                                        <img src="{{ asset('storage/' . $shop->logo_path) }}" alt="{{ $shop->name }}" class="w-20 h-20 rounded-2xl object-cover border-4 border-white shadow-md bg-white">
                                    @else
                                        <div class="w-20 h-20 rounded-2xl border-4 border-white shadow-md bg-white flex items-center justify-center text-brand">
                                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Card Body -->
                                <div class="pt-12 p-8 flex flex-col flex-grow">
                                    <div class="mb-4">
                                        <h3 class="text-2xl font-bold text-gray-900 group-hover:text-brand transition-colors">{{ $shop->name }}</h3>
                                        <div class="flex items-center mt-2 text-sm text-gray-500">
                                            <svg class="w-4 h-4 mr-1 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <span>Reward every {{ $shop->visits_required }} visits</span>
                                        </div>
                                    </div>
                                    
                                    <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed text-sm flex-grow">
                                        {{ $shop->description }}
                                    </p>

                                    <div class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between text-brand font-bold text-sm uppercase tracking-wider">
                                        <span>Visit Shop</span>
                                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-10">
                    {{ $shops->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">No shops found</h3>
                    <p class="mt-1 text-gray-500">Try adjusting your search terms.</p>
                    @if(request('search'))
                        <div class="mt-6">
                            <a href="{{ route('shops.index') }}" class="text-brand font-bold hover:underline">Clear Search</a>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
