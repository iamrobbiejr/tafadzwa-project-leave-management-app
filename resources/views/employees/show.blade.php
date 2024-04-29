<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees | View Employee Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-4">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-base font-semibold leading-7 text-gray-900">Employee Information</h3>
                        <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Personal details</p>
                    </div>
                    <div class="mt-6 border-t border-gray-100">
                        <dl class="divide-y divide-gray-100">
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Full name</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $employee->name }}</dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Phone</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $employee->mobile }}</dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Email address</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $employee->email }}</dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Leave Balances</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    Fugiat ipsum ipsum deserunt culpa aute sint do nostrud anim incididunt cillum culpa consequat. Ex
                                    cepteur qui ipsum aliquip consequat sint. Sit id mollit nulla mollit nostrud in ea officia proident. Ir
                                    ure nostrud pariatur mollit ad adipisicing reprehenderit deserunt qui eu.</dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Leave Requests</dt>
                                <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                    <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                                        <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                                            <div class="flex w-0 flex-1 items-center">

                                                <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                                    <span class="truncate font-medium">Annual Leave | From:  | To: </span>
                                                    <span class="flex-shrink-0 text-gray-400">Number of days: 2 days</span>
                                                </div>
                                            </div>
                                            <div class="ml-4 flex-shrink-0 p-2">
                                                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Approve</a>
                                                <a href="#" class="ml-2 font-medium text-red-600 hover:text-red-500">Reject</a>
                                            </div>
                                        </li>

                                    </ul>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
