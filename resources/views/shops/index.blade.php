<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Available Shops') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($shops as $shop)
                    <a href="{{ route('shops.show', $shop) }}" class="block group h-full">
                        <div class="bg-white overflow-hidden shadow-lg sm:rounded-3xl hover:shadow-2xl transition duration-300 border border-gray-100 h-full flex flex-col">
                            <div class="p-8 flex flex-col h-full">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-2xl font-bold text-gray-900 group-hover:text-brand transition-colors">{{ $shop->name }}</h3>
                                    <div class="w-10 h-10 bg-orange-50 rounded-full flex items-center justify-center text-brand">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </div>
                                </div>
                                <p class="text-gray-600 mb-6 flex-grow leading-relaxed">{{ Str::limit($shop->description, 100) }}</p>
                                <div class="mt-auto pt-6 border-t border-gray-100 flex items-center justify-between">
                                    <span class="text-xs font-bold bg-orange-100 text-brand px-3 py-1.5 rounded-full uppercase tracking-wide">
                                        Reward @ {{ $shop->visits_required }} visits
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
