<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="isolate bg-white px-6 py-12 sm:py-24 lg:px-8">

                    <div class="mx-auto max-w-2xl text-center">
                        <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-4xl">Fill in form and submit</h2>
                    </div>
                    <form action="{{ route('employees.store') }}" method="POST" class="mx-auto mt-6 max-w-xl sm:mt-8">
                        @csrf

                        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label for="first-name" class="block text-sm font-semibold leading-6 text-gray-900">Full name</label>
                                <div class="mt-2.5">
                                    <input type="text" name="name" id="name" autocomplete="name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="email" class="block text-sm font-semibold leading-6 text-gray-900">Email</label>
                                <div class="mt-2.5">
                                    <input type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="mobile" class="block text-sm font-semibold leading-6 text-gray-900">Phone number</label>
                                <div class="relative mt-2.5">
                                    <div class="absolute inset-y-0 left-0 flex items-center">
                                        <label for="country" class="sr-only">Country</label>
                                        <select id="country" name="country" class="h-full rounded-md border-0 bg-transparent bg-none py-0 pl-4 pr-9 text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                                            <option>ZW</option>
                                        </select>
                                        <svg class="pointer-events-none absolute right-3 top-0 h-full w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="tel" name="mobile" id="mobile" autocomplete="tel" class="block w-full rounded-md border-0 px-3.5 py-2 pl-20 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
                                </div>
                            </div>
                            <div >
                                <label for="password" class="block text-sm font-semibold leading-6 text-gray-900">Password</label>
                                <div class="mt-2.5">
                                    <input type="password" name="password" id="password" autocomplete="password" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>
                            <div >
                                <label for="confirm_password" class="block text-sm font-semibold leading-6 text-gray-900">Confirm Password</label>
                                <div class="mt-2.5">
                                    <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="confirm_password" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
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
