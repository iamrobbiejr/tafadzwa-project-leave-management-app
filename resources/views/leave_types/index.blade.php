<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leave Types') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto rounded-lg shadow p-4">
                    <div class="flex justify-between mb-4">
                        <a href="{{ route('leave-types.create') }}" class="inline-flex items-center px-2 py-2 text-sm font-medium text-center text-white
                        rounded-lg bg-gradient-to-r from-green-400 to-gray-400 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-green-500">
                            Create New Leave Type
                        </a>

                    </div>
                    <table class="table w-full text-sm text-left table-auto">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Days per Year</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($leaveTypes as $leaveType)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-6 py-4">{{ $leaveType->name }}</td>
                                <td class="px-6 py-4">{{ $leaveType->days_per_year }}</td>
                                <td class="px-6 py-4 flex space-x-2">
                                    <a href="{{ route('employees.edit', $leaveType->id) }}" class="inline-flex items-center px-2 py-1 text-sm font-medium text-center text-white rounded-lg bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-500">
                                        Edit
                                        <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.585 3.585a2 2 0 112.828 2.828l-.707.707 3.5-3.5-1.414-1.414zM11.311 18.811a2 2 0 01-2.828-2.828l.707-.707-3.5 3.5 1.414 1.414zM15 8a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">No leave types found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
