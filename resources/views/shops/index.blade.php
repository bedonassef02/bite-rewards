<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Available Shops') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($shops as $shop)
                    <a href="{{ route('shops.show', $shop) }}" class="block group">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-200 h-full">
                            <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col h-full">
                                <h3 class="text-xl font-bold mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $shop->name }}</h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 flex-grow">{{ Str::limit($shop->description, 100) }}</p>
                                <div class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-700 flex justify-between items-center">
                                    <span class="text-xs font-semibold bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 px-2 py-1 rounded">
                                        Reward every {{ $shop->visits_required }} visits
                                    </span>
                                    <span class="text-indigo-600 dark:text-indigo-400 text-sm font-medium">View &rarr;</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
