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
                @if(Auth::user()->isAdmin() === true)
                <div class="flex flex-row gap-4 p-4">
                    <div class="w-full bg-gradient-to-r from-green-200 to-gray-20 rounded-lg shadow-md p-6 m-auto">
                        <h3 class="text-xl font-medium text-gray-700">Employees</h3>
                        <p class="text-2xl font-bold text-gray-900 mt-2">
                            {{--                            {{ $employeeCount }}--}}
                            0
                        </p>
                    </div>
                    <div class="w-full bg-gradient-to-r from-green-200 to-gray-20 rounded-lg shadow-md p-6 m-auto">
                        <h3 class="text-xl font-medium text-gray-700">Pending Leave Requests</h3>
                        <p class="text-2xl font-bold text-gray-900 mt-2">
                            {{--                            {{ $pendingLeaveCount }}--}}
                            0
                        </p>
                    </div>
                </div>
                @endif
                @if(Auth::user()->isAdmin() === false)
                    <div class="flex flex-row gap-4 p-4 mt-4">
                        @forelse ($leaveBalances as $leaveBalance)
                        <div class="w-full bg-gradient-to-r from-green-200 to-gray-20 rounded-lg shadow-md p-6 m-auto">
                            <h3 class="text-l font-medium text-gray-700">{{ $leaveBalance->leaveType($leaveBalance->leave_type_id)->name }}</h3>
                            <p class="text-l font-bold text-gray-900 mt-2">
                                {{--                            {{ $employeeCount }}--}}
                                Remaining Days: {{ $leaveBalance->remaining_days }}
                            </p>
                            <p class="text-l font-bold text-gray-900 mt-2">
                                {{--                            {{ $employeeCount }}--}}
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
                            <a href="{{ route('leave-requests.create') }}" class="inline-flex items-center px-2 py-2 text-sm font-medium text-center text-white
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
                                    <td class="px-6 py-4 border border-gray-200">{{ $leaveRequest->employee->name }}</td>
                                    <td class="px-6 py-4 border border-gray-200">{{ $leaveRequest->leaveType->name }}</td>
                                    <td class="px-6 py-4 border border-gray-200">{{ $leaveRequest->start_date->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 border border-gray-200">{{ $leaveRequest->end_date->format('Y-m-d') }}</td>
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
                                        <a href="{{ route('leave-requests.show', $leaveRequest) }}"
                                           class="text-blue-500 hover:underline">View</a>
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
</x-app-layout>
