@php use Illuminate\Support\Facades\Auth; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
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
                @if(Auth::user()->isAdmin() === true)
                <div class="flex flex-row gap-4 p-4">
                    <div class="w-full bg-gradient-to-r from-green-200 to-gray-20 rounded-lg shadow-md p-6 m-auto">
                        <h3 class="text-xl font-medium text-gray-700">Employees</h3>
                        <p class="text-2xl font-bold text-gray-900 mt-2">
                            {{ $employeeCount }}
                        </p>
                    </div>
                    <div class="w-full bg-gradient-to-r from-green-200 to-gray-20 rounded-lg shadow-md p-6 m-auto">
                        <h3 class="text-xl font-medium text-gray-700">Pending Leave Requests</h3>
                        <p class="text-2xl font-bold text-gray-900 mt-2">
                            {{ $pendingLeaveCount }}
                        </p>
                    </div>
                </div>
                @endif
                @if(Auth::user()->isAdmin() === false)
                    <div class="flex flex-row gap-4 p-4 mt-4">
                        @forelse ($leaveBalances as $leaveBalance)
                        <div class="w-full bg-gradient-to-r from-green-200 to-gray-20 rounded-lg shadow-md p-6 m-auto">
                            <h3 class="text-l font-bold text-gray-900">{{ $leaveBalance->leaveType($leaveBalance->leave_type_id)->name }}</h3>
                            <p class="text-l font-medium text-gray-700 mt-2">

                                Remaining Days: {{ $leaveBalance->remaining_days }}
                            </p>
                            <p class="text-l font-medium text-gray-700 mt-2">

                                Leave Days Taken: {{ $leaveBalance->days_taken }}
                            </p>
                        </div>
                        @empty
                            <div class="w-full bg-gradient-to-r from-green-200 to-gray-20 rounded-lg shadow-md p-6 m-auto">
                                <h3 class="text-xl font-medium text-gray-700">No Leave Balances for this employee</h3>
                            </div>
                        @endforelse

                    </div>

                    {{--                    request table--}}
                    <div class="overflow-x-auto rounded-lg mt-4 shadow p-4">
                        <div class="flex justify-between mb-4">
                            <a href="{{ route('apply') }}" class="inline-flex items-center px-2 py-2 text-sm font-medium text-center text-white
                        rounded-lg bg-gradient-to-r from-green-400 to-gray-400 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-green-500">
                                Apply Leave
                            </a>

                        </div>
                        <table class="table-auto w-full">
                            <thead>
                            <tr class="bg-gray-100 text-gray-700 font-bold rounded-t-lg">
                                <th class="px-6 py-2 border border-gray-200">Leave Type</th>
                                <th class="px-6 py-2 border border-gray-200">Start Date</th>
                                <th class="px-6 py-2 border border-gray-200">End Date</th>
                                <th class="px-6 py-2 border border-gray-200">Status</th>
                                <th class="px-6 py-2 border border-gray-200">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($leaveRequests as $leaveRequest)
                                <tr>
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
                                        <a href="{{ route('update_leave', $leaveRequest) }}"
                                           class="text-blue-500 hover:underline">Edit Application</a>
                                            <form action="{{ route('leave-requests.destroy', $leaveRequest) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline">
                                                    Cancel Application
                                                </button>
                                            </form>

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
                @endif

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
