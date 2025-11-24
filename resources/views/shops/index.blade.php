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
            
            <!-- Search & Sort -->
            <div class="mb-12 flex flex-col md:flex-row gap-4 max-w-4xl mx-auto">
                <!-- Search Bar -->
                <div class="flex-grow relative group">
                    <form action="{{ route('shops.index') }}" method="GET" class="w-full">
                        @if(request('sort'))
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                        @endif
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                            <svg class="h-6 w-6 text-gray-400 group-focus-within:text-brand transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-14 pr-12 py-4 border-2 border-gray-100 rounded-full leading-5 bg-white placeholder-gray-400 focus:outline-none focus:bg-white focus:border-brand focus:ring-0 text-lg shadow-sm hover:shadow-md transition-all duration-200" placeholder="Search for shops...">
                        @if(request('search'))
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                <a href="{{ route('shops.index', ['sort' => request('sort')]) }}" class="p-1 rounded-full hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition-colors">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </a>
                            </div>
                        @endif
                    </form>
                </div>

                <!-- Sort Dropdown -->
                <div class="flex-shrink-0 relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" class="w-full md:w-48 h-full px-6 py-4 bg-white border-2 border-gray-100 rounded-full flex items-center justify-between text-gray-700 font-medium hover:border-brand hover:text-brand transition-all duration-200 shadow-sm">
                        <span>
                            @switch(request('sort'))
                                @case('oldest') Oldest First @break
                                @case('name') Name (A-Z) @break
                                @default Newest First
                            @endswitch
                        </span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    
                    <div x-show="open" class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50" style="display: none;">
                        <a href="{{ route('shops.index', ['search' => request('search'), 'sort' => 'newest']) }}" class="block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-brand">Newest First</a>
                        <a href="{{ route('shops.index', ['search' => request('search'), 'sort' => 'oldest']) }}" class="block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-brand">Oldest First</a>
                        <a href="{{ route('shops.index', ['search' => request('search'), 'sort' => 'name']) }}" class="block px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-brand">Name (A-Z)</a>
                    </div>
                </div>
            </div>

            @if($shops->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($shops as $shop)
                        <a href="{{ route('shops.show', $shop) }}" class="group block h-full transform hover:-translate-y-2 transition-all duration-300">
                            <div class="bg-white rounded-3xl shadow-sm hover:shadow-xl overflow-hidden border {{ $shop->isPremium() ? 'border-brand/50 ring-4 ring-brand/10' : 'border-gray-100' }} h-full flex flex-col relative">
                                <!-- Featured Badge -->
                                @if($shop->isPremium())
                                    <div class="absolute top-4 right-4 z-20 bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        Featured
                                    </div>
                                @endif

                                <!-- Card Header Gradient -->
                                <div class="h-32 bg-gradient-to-r {{ $shop->isPremium() ? 'from-brand to-pink-600' : 'from-gray-100 to-gray-200' }} relative">
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
