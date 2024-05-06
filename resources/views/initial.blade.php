<x-guest-layout>

    <div class="mx-auto max-w-2xl py-16 sm:py-24 lg:max-w-none lg:py-32">
        <div class='mb-4 font-medium text-sm text-green-600'>
            {{ session('status') }}
        </div>
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Create Leave Type</h2>

        <form method="POST" action="{{ route('initial.store') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Leave Type')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="Annual Leave" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-input-label for="days_per_year" :value="__('Days per Year')" />

            <x-text-input id="days_per_year" class="block mt-1 w-full"
                          type="number"
                          name="days_per_year"
                          min="1"
                          required autocomplete="days_per_year" />

            <x-input-error :messages="$errors->get('days_per_year')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ms-3">
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </form>
    </div>
</x-guest-layout>
