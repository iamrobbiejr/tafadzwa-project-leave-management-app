<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees | View Employee Details') }}
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
                    @if (session()->has('error'))
                        <div id="alert-div1" class="fixed top-8 right-0 z-50 px-4 py-3 rounded-full shadow-md" role="alert">
                            <div class="bg-gradient-to-r from-red-400 to-gray-500 flex items-center text-white p-2 rounded-full">
                                <span class="font-medium">{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif
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
                                    <div class="flex flex-row gap-4 p-2 mt-0">
                                        @forelse ($leaveBalances as $leaveBalance)
                                            <div class="w-full bg-gradient-to-r from-green-200 to-gray-20 rounded-lg shadow-md p-2 m-auto">
                                                <h3 class="text-sm font-bold text-gray-900">{{ $leaveBalance->leaveType($leaveBalance->leave_type_id)->name }}</h3>
                                                <p class="text-sm font-medium text-gray-700 mt-2">

                                                    Remaining Days: {{ $leaveBalance->remaining_days }}
                                                </p>
                                                <p class="text-sm font-medium text-gray-700 mt-2">

                                                    Leave Days Taken: {{ $leaveBalance->days_taken }}
                                                </p>
                                            </div>
                                        @empty
                                            <div class="w-full bg-gradient-to-r from-green-200 to-gray-20 rounded-lg shadow-md p-6 m-auto">
                                                <h3 class="text-xl font-medium text-gray-700">No Leave Balances for this employee</h3>
                                            </div>
                                        @endforelse

                                    </div>
                                </dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Pending Leave Requests</dt>
                                <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                    <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                                        @forelse($leaveRequests as $leaveRequest)
                                            <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                                                <div class="flex w-0 flex-1 items-center">

                                                    <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                                        <span class="truncate font-medium">{{ $leaveRequest->leaveType($leaveRequest->leave_type_id)->name }}
                                                            &nbsp;|&nbsp; From:&nbsp; {{ Carbon\Carbon::parse($leaveRequest->start_date)->format('Y-m-d') }}
                                                            &nbsp;| &nbsp; To:&nbsp; {{ Carbon\Carbon::parse($leaveRequest->end_date)->format('Y-m-d') }}</span>
                                                        <span class="flex-shrink-0 text-gray-400">Number of days:&nbsp; {{ $leaveRequest->no_of_days }}&nbsp; days</span>
                                                    </div>
                                                </div>
                                                <div class="ml-4 flex-shrink-0 p-2">
                                                    <form action="{{ route('approve', $leaveRequest->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="font-medium text-indigo-600 hover:text-indigo-500">Approve</button>
                                                    </form>
                                                    <form action="{{ route('reject', $leaveRequest->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="ml-2 font-medium text-red-600 hover:text-red-500">Reject</button>
                                                    </form>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                                                <div class="flex w-0 flex-1 items-center">
                                                    <div class="w-full bg-gradient-to-r from-green-200 to-gray-20 rounded-lg shadow-md p-6 m-auto">
                                                        <h3 class="text-xl font-medium text-gray-700">No pending request this employee</h3>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforelse


                                    </ul>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        function closeAlert() {
            const alertDiv = document.getElementById('alert-div');
            const alertDiv1 = document.getElementById('alert-div1');
            setTimeout(() => {
                alertDiv.remove()
                alertDiv1.remove()
            }, 2000); // Hide after 5 seconds (5000 milliseconds)
        }

        window.onload = closeAlert; // Call closeAlert on page load

    </script>
</x-app-layout>
