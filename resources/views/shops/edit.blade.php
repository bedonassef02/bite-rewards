<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Shop') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-gray-100">
                <div class="p-10 text-gray-900">
                    <form method="POST" action="{{ route('shops.update', $shop) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Shop Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $shop->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Logo -->
                        <div class="mt-6">
                            <x-input-label for="logo" :value="__('Shop Logo (Optional)')" />
                            @if($shop->logo_path)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $shop->logo_path) }}" alt="Current Logo" class="w-16 h-16 rounded-full object-cover">
                                </div>
                            @endif
                            <input id="logo" name="logo" type="file" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-brand hover:file:bg-orange-100" />
                            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mt-6">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" class="block mt-1 w-full border-gray-200 focus:border-brand focus:ring-brand rounded-xl shadow-sm" rows="4">{{ old('description', $shop->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Visits Required -->
                        <div class="mt-6">
                            <x-input-label for="visits_required" :value="__('Visits Required for Reward')" />
                            <x-text-input id="visits_required" class="block mt-1 w-full" type="number" name="visits_required" :value="old('visits_required', $shop->visits_required)" required min="3" max="10" />
                            <x-input-error :messages="$errors->get('visits_required')" class="mt-2" />
                        </div>

                        <div class="border-t border-gray-100 my-8"></div>
                        <h3 class="text-lg font-bold mb-4">Reward Customization</h3>

                        <!-- Reward Name -->
                        <div class="mt-4">
                            <x-input-label for="reward_name" :value="__('Reward Name (e.g., Free Coffee)')" />
                            <x-text-input id="reward_name" class="block mt-1 w-full" type="text" name="reward_name" :value="old('reward_name', $shop->reward_name)" placeholder="Free Reward" />
                            <x-input-error :messages="$errors->get('reward_name')" class="mt-2" />
                        </div>

                        <!-- Reward Image -->
                        <div class="mt-6">
                            <x-input-label for="reward_image" :value="__('Reward Image (Optional)')" />
                            @if($shop->reward_image_path)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $shop->reward_image_path) }}" alt="Current Reward" class="w-16 h-16 rounded-lg object-cover">
                                </div>
                            @endif
                            <input id="reward_image" name="reward_image" type="file" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-brand hover:file:bg-orange-100" />
                            <x-input-error :messages="$errors->get('reward_image')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <button type="submit" class="inline-flex items-center px-8 py-4 bg-brand border border-transparent rounded-full font-bold text-white uppercase tracking-widest hover:bg-orange-600 focus:bg-orange-600 active:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-orange-200">
                                {{ __('Update Shop') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
