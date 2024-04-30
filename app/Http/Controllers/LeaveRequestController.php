<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $leaveRequests = LeaveRequest::latest()->paginate(10);
        return view('leave_requests.index', compact('leaveRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        $leave_types = LeaveType::all();

        return view('leave_requests.create')->with(['employees' => $employees, 'types' => $leave_types]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'no_of_days' => 'required|numeric|min:1',
            'reason' => 'string|nullable',
        ]);

        // Find the leave balance record for this employee and leave type
        $leaveBalance = LeaveBalance::where('employee_id', $request->employee_id)
            ->where('leave_type_id', $request->leave_type_id)
            ->firstOrFail();

        // Validate if sufficient days are available
        if ($leaveBalance->remaining_days < $request->no_of_days) {
            return redirect()->back()->with('error', 'Insufficient leave balance for this request.');
        }

        LeaveRequest::create($validatedData);

        if (Auth::user()->isAdmin())
        {
            return redirect()->route('leave-requests.index')->with('success', 'Leave Request created successfully.');
        }

        return redirect()->route('dashboard')->with('success', 'Leave Request created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaveRequest $leaveRequest)
    {
        $leaveBalances = LeaveBalance::where('employee_id',$leaveRequest->employee_id)->get();

        return view('leave_requests.show', compact('leaveRequest', 'leaveBalances'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveRequest $leaveRequest)
    {

        return view('leave_requests.edit', compact('leaveRequest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeaveRequest $leaveRequest)
    {

        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'no_of_days' => 'required|numeric|min:1',
            'reason' => 'string|nullable',
        ]);

        // Find the leave balance record for this employee and leave type
        $leaveBalance = LeaveBalance::where('employee_id', $request->employee_id)
            ->where('leave_type_id', $request->leave_type_id)
            ->firstOrFail();

        // Validate if sufficient days are available
        if ($leaveBalance->remaining_days < $request->no_of_days) {
            return redirect()->back()->with('error', 'Insufficient leave balance for this request.');
        }

        $leaveRequest->update($request->all());

        if (Auth::user()->isAdmin())
        {
            return redirect()->route('leave-requests.index')->with('success', 'Leave Request updated successfully.');
        }

        return redirect()->route('dashboard')->with('success', 'Leave Request updated successfully.');

    }

    public function approve(String $id): RedirectResponse
    {
        $leaveRequest = LeaveRequest::find($id);

        // Find the leave balance record for this employee and leave type
        $leaveBalance = LeaveBalance::where('employee_id', $leaveRequest->employee_id)
            ->where('leave_type_id', $leaveRequest->leave_type_id)
            ->firstOrFail();

        // Validate if sufficient days are available
        if ($leaveBalance->remaining_days < $leaveRequest->no_of_days) {
            return redirect()->back()->with('error', 'Insufficient leave balance for this request.');
        }

        // Deduct requested days from leave balance
        $leaveBalance->decrement('remaining_days', $leaveRequest->no_of_days);
        $leaveBalance->increment('days_taken', $leaveRequest->no_of_days);

        // Update leave request status
        $leaveRequest->update([
            'status' => 'approved',
        ]);

        return redirect()->back()->with('success', 'Leave Request approved successfully.');
    }

    public function reject(String $id): RedirectResponse
    {
        $leaveRequest = LeaveRequest::find($id);
        $leaveRequest->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Leave Request rejected successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveRequest $leaveRequest): RedirectResponse
    {

        $leaveRequest->delete();

        if (Auth::user()->isAdmin())
        {
            return redirect()->route('leave-requests.index')->with('success', 'Leave Request cancelled successfully.');
        }

        return redirect()->route('dashboard')->with('success', 'Leave Request cancelled successfully.');
    }
}
