<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leave Balances') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @if (session()->has('error'))
                    <div id="alert-div" class="fixed top-8 right-0 z-50 px-4 py-3 rounded-full shadow-md" role="alert">
                        <div class="bg-gradient-to-r from-red-400 to-gray-500 flex items-center text-white p-2 rounded-full">
                            <span class="font-medium">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif
                <h3 class="text-2xl font-semibold">Filter</h3>
                <form method="post" action="{{ route('filter') }}" class="inline-flex items-center mt-4">
                    @csrf

                    <select name="employee_id" class="block h-full w-full rounded-md border-0 px-8 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="">Select Employee</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                    <select name="leave_type_id" class="block h-full w-full ml-2 rounded-md border-0 px-9 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="">Select Leave Type</option>
                        @foreach ($leaveTypes as $leaveType)
                            <option value="{{ $leaveType->id }}">{{ $leaveType->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="inline-flex ml-4 items-center px-4 py-1 text-sm font-medium text-center text-white
                   rounded-lg bg-gradient-to-r from-green-400 to-gray-400 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-green-500">Submit</button>
                </form>
                <div class="overflow-x-auto rounded-lg mt-4 shadow p-4">
                    <table class="table-auto w-full">
                        <thead>
                        <tr class="bg-gray-100 text-gray-700 font-bold rounded-t-lg">
                            <th class="px-6 py-3 border border-gray-200">Employee</th>
                            <th class="px-6 py-3 border border-gray-200">Leave Type</th>
                            <th class="px-6 py-3 border border-gray-200">Remaining Days</th>
                            <th class="px-6 py-3 border border-gray-200">Leave Taken</th>
                            <th class="px-6 py-3 border border-gray-200">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($leave_balances as $leaveBalance)
                            <tr class="text-center">
                                <td class="px-6 py-4 border border-gray-200">{{ $leaveBalance->employee($leaveBalance->employee_id)->name }}</td>
                                <td class="px-6 py-4 border border-gray-200">{{ $leaveBalance->leaveType($leaveBalance->leave_type_id)->name }}</td>
                                <td class="px-6 py-4 border border-gray-200">{{ $leaveBalance->remaining_days }}</td>
                                <td class="px-6 py-4 border border-gray-200">{{ $leaveBalance->days_taken }}</td>
                                <td class="px-6 py-4 border border-gray-200">
                                    <a href="{{ route('employees.show', $leaveBalance->employee_id) }}" class="inline-flex items-center px-2 py-1 text-sm font-medium text-center text-white rounded-lg bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-500">
                                        View Leave Requests
                                        <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a1 1 0 000-2v5h2a1 1 0 00.994.59l3 3a1 1 0 001.414-.59L13 13.5V9zM13.5 7a1.5 1.5 0 01-3 0v6a1.5 1.5 0 01-3-1.5V7z" clip-rule="evenodd"></path></svg>
                                    </a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center">No data found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    @if ($leave_balances->hasPages())
                        <div class="p-4">
                            {{ $leave_balances->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function closeAlert() {
            const alertDiv = document.getElementById('alert-div');
            setTimeout(() => alertDiv.remove(), 2000); // Hide after 5 seconds (5000 milliseconds)
        }

        window.onload = closeAlert; // Call closeAlert on page load

    </script>
</x-app-layout>
