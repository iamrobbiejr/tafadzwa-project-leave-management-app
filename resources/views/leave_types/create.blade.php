<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Leave Type') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="isolate bg-white px-6 py-12 sm:py-24 lg:px-8">

                    <div class="mx-auto max-w-2xl text-center">
                        <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-4xl">Fill in form and submit</h2>
                    </div>
                    <form action="{{ route('leave-types.store') }}" method="POST" class="mx-auto mt-6 max-w-xl sm:mt-8">
                        @csrf

                        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label for="first-name" class="block text-sm font-semibold leading-6 text-gray-900">Name</label>
                                <div class="mt-2.5">
                                    <input type="text" name="name" id="name" autocomplete="name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="days_per_year" class="block text-sm font-semibold leading-6 text-gray-900">Days per Year</label>
                                <div class="relative mt-2.5">
                                    <input type="number" name="days_per_year" id="days_per_year" autocomplete="days" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <x-input-error :messages="$errors->get('days_per_year')" class="mt-2" />
                                </div>
                            </div>

                        </div>
                        <div class="mt-10">
                            <button type="submit" class="block w-full rounded-md
                            bg-gradient-to-r from-green-400 to-gray-400 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Submit & Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
