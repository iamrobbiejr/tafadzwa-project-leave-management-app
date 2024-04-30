<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leave Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                @if (session()->has('success'))
                    <div id="alert-div" class="fixed top-8 right-0 z-50 px-4 py-3 rounded-full shadow-md" role="alert">
                        <div class="bg-gradient-to-r from-green-500 to-gray-200 flex items-center text-white p-4 rounded-full">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2-2 4 4M17 12l-2-2 4 4"></path></svg>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif
                <div class="overflow-x-auto rounded-lg mt-4 shadow p-4">
                    <div class="flex justify-between mb-4">
                        <a href="{{ route('leave-requests.create') }}" class="inline-flex items-center px-2 py-2 text-sm font-medium text-center text-white
                        rounded-lg bg-gradient-to-r from-green-400 to-gray-400 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-green-500">
                            Apply Leave on Behalf
                        </a>

                    </div>
                    <table class="table-auto w-full">
                        <thead>
                        <tr class="bg-gray-100 text-gray-700 font-bold rounded-t-lg">
                            <th class="px-6 py-3 border border-gray-200">Employee</th>
                            <th class="px-6 py-3 border border-gray-200">Leave Type</th>
                            <th class="px-6 py-3 border border-gray-200">Start Date</th>
                            <th class="px-6 py-3 border border-gray-200">End Date</th>
                            <th class="px-6 py-3 border border-gray-200">Number of Days</th>
                            <th class="px-6 py-3 border border-gray-200">Status</th>
                            <th class="px-6 py-3 border border-gray-200">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($leaveRequests as $leaveRequest)
                            <tr>
                                <td class="px-6 py-4 border border-gray-200">{{ $leaveRequest->employee($leaveRequest->employee_id)->name }}</td>
                                <td class="px-6 py-4 border border-gray-200">{{ $leaveRequest->leaveType($leaveRequest->leave_type_id)->name }}</td>
                                <td class="px-6 py-4 border border-gray-200">{{ Carbon\Carbon::parse($leaveRequest->start_date)->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 border border-gray-200">{{ Carbon\Carbon::parse($leaveRequest->end_date)->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 border border-gray-200">{{ $leaveRequest->no_of_days }}</td>
                                <td class="px-6 py-4 border border-gray-200">
                                    @if ($leaveRequest->status === 'pending')
                                        Pending
                                    @elseif ($leaveRequest->status === 'approved')
                                        Approved
                                    @else
                                        Rejected
                                    @endif
                                </td>
                                <td class="px-6 py-4 border border-gray-200">
                                    @if ($leaveRequest->status === 'pending')
                                    <a href="{{ route('leave-requests.show', $leaveRequest) }}"
                                       class="text-blue-500 hover:underline">View</a> |
                                        <a href="{{ route('leave-requests.edit', $leaveRequest) }}"
                                           class="text-green-500 hover:underline">Edit</a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center">No leave requests found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    @if ($leaveRequests->hasPages())
                        <div class="p-4">
                            {{ $leaveRequests->links() }}
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

