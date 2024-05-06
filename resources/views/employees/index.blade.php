<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (session()->has('success'))
                    <div id="alert-div" class="fixed top-8 right-0 z-50 px-4 py-3 rounded-full shadow-md" role="alert">
                        <div class="bg-gradient-to-r from-green-600 to-gray-200 flex items-center text-white p-4 rounded-full">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2-2 4 4M17 12l-2-2 4 4"></path></svg>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif
                <div class="overflow-x-auto rounded-lg shadow p-4">
                    <div class="flex justify-between mb-4">
                        <a href="{{ route('employees.create') }}" class="inline-flex items-center px-2 py-2 text-sm font-medium text-center text-white
                        rounded-lg bg-gradient-to-r from-green-400 to-gray-400 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-green-500">
                            Create New Employee
                        </a>

                    </div>
                    <table class="table w-full text-sm text-left table-auto">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Mobile</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($employees as $employee)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-6 py-4">{{ $employee->name }}</td>
                                <td class="px-6 py-4">{{ $employee->email }}</td>
                                <td class="px-6 py-4">{{ $employee->mobile }}</td>
                                <td class="px-6 py-4 flex space-x-2">
                                    <a href="{{ route('employees.show', $employee->id) }}" class="inline-flex items-center px-2 py-1 text-sm font-medium text-center text-white rounded-lg bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-500">
                                        Show
                                        <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a1 1 0 000-2v5h2a1 1 0 00.994.59l3 3a1 1 0 001.414-.59L13 13.5V9zM13.5 7a1.5 1.5 0 01-3 0v6a1.5 1.5 0 01-3-1.5V7z" clip-rule="evenodd"></path></svg>
                                    </a>
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="inline-flex items-center px-2 py-1 text-sm font-medium text-center text-white rounded-lg bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-500">
                                        Edit
                                        <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.585 3.585a2 2 0 112.828 2.828l-.707.707 3.5-3.5-1.414-1.414zM11.311 18.811a2 2 0 01-2.828-2.828l.707-.707-3.5 3.5 1.414 1.414zM15 8a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">No employees found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    @if ($employees->hasPages())
                        <div class="p-4">
                            {{ $employees->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
