<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My QR Code') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    <p class="mb-8 text-lg">Show this code to the shop staff to collect your stamp.</p>
                    
                    <div class="inline-block p-4 bg-white rounded-xl shadow-xl">
                        <!-- We can use the API we made or just generate it here. Using the API is cleaner for separation but inline is faster for view. 
                             Let's use the simple-qrcode blade directive since we installed the package. -->
                        {!! QrCode::size(250)->generate(Auth::id()) !!}
                    </div>

                    <div class="mt-8">
                        <p class="text-sm text-gray-500 dark:text-gray-400">User ID: {{ Auth::id() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
