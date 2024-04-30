<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Leave Application') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="isolate bg-white px-6 py-6 sm:py-12 lg:px-8">
                    @if (session()->has('error'))
                        <div id="alert-div" class="fixed top-8 right-0 z-50 px-4 py-3 rounded-full shadow-md" role="alert">
                            <div class="bg-gradient-to-r from-red-400 to-gray-500 flex items-center text-white p-2 rounded-full">
                                <span class="font-medium">{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="mx-auto max-w-2xl text-center">
                        <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-4xl">Update details and submit</h2>
                    </div>
                    <form action="{{ route('leave-requests.update', $leaveRequest) }}" method="POST" class="mx-auto mt-6 max-w-xl sm:mt-8">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label for="email" class="block text-sm font-semibold leading-6 text-gray-900">Leave Type</label>
                                <div class="mt-2.5">
                                    <input type="text" disabled value="{{ $leaveRequest->leaveType($leaveRequest->leave_type_id)->name }}" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <x-input-error :messages="$errors->get('leave_type_id')" class="mt-2" />
                                </div>
                                <input type="hidden" name="employee_id" value="{{ $leaveRequest->employee_id }}">
                                <input type="hidden" name="leave_type_id" value="{{ $leaveRequest->leave_type_id }}">
                            </div>
                            <div >
                                <label for="start_date" class="block text-sm font-semibold leading-6 text-gray-900">Start Date</label>
                                <div class="mt-2.5">
                                    <input type="date" value="{{ $leaveRequest->start_date }}" required name="start_date" id="start_date" autocomplete="start_date" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                                </div>
                            </div>
                            <div >
                                <label for="end_date" class="block text-sm font-semibold leading-6 text-gray-900">End Date</label>
                                <div class="mt-2.5">
                                    <input type="date" value="{{ $leaveRequest->end_date }}" disabled name="end_date" id="end_date" autocomplete="end_date" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="no_of_days" class="block text-sm font-semibold leading-6 text-gray-900">Number of days</label>
                                <div class="mt-2.5">
                                    <input type="number" required value="{{ $leaveRequest->no_of_days }}" readonly name="no_of_days" id="no_of_days" class="block w-full
                                     bg-gray-200 rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <x-input-error :messages="$errors->get('no_of_days')" class="mt-2" />
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="reason" class="block text-sm font-semibold leading-6 text-gray-900">Reason</label>
                                <div class="mt-2.5">
                                    <textarea name="reason" id="reason" autocomplete="reason"
                                              class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset
                                            ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm
                                            sm:leading-6">{{ $leaveRequest->reason }}</textarea>
                                    <x-input-error :messages="$errors->get('reason')" class="mt-2" />
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

    <script type="text/javascript">
        function closeAlert() {
            const alertDiv = document.getElementById('alert-div');
            setTimeout(() => alertDiv.remove(), 2000); // Hide after 5 seconds (5000 milliseconds)
        }

        window.onload = closeAlert; // Call closeAlert on page load

        // get start date, end date, and number of days fields
        const startInput = document.getElementById('start_date')
        const endInput = document.getElementById('end_date')
        const numInput = document.getElementById('no_of_days')

        // Set start date min value to today
        const today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format
        startInput.min = today;

        // Disable end date input initially
        endInput.disabled = true;

        startInput.addEventListener('change', function() {
            const selectedStartDate = new Date(this.value);
            numInput.value = ""; // Clear number of days if start date is changed

            // Enable end date input only if start date is valid
            if (selectedStartDate.getTime() > 0) {
                endInput.disabled = false;
                endInput.min = this.value; // Set min date for end date based on start date
            } else {
                endInput.disabled = true;
                endInput.value = ""; // Clear end date if start date is invalid
                numInput.value = ""; // Clear number of days if start date is invalid
            }
        });

        endInput.addEventListener('change', function() {
            const selectedEndDate = new Date(this.value);
            const selectedStartDate = new Date(startInput.value);

            // Calculate number of days only if both dates are valid
            if (selectedEndDate.getTime() > 0 && selectedStartDate.getTime() > 0) {
                const diffInMs = Math.abs(selectedEndDate - selectedStartDate);
                const oneDay = 1000 * 60 * 60 * 24;
                // Round up to nearest day
                numInput.value = Math.ceil(diffInMs / oneDay);
            } else {
                numInput.value = ""; // Clear number of days if end date is invalid
            }
        });

    </script>
</x-app-layout>
