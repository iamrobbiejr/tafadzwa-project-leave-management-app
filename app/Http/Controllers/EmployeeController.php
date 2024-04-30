<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::latest()->paginate(10);

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function apply()
    {
        $emp = Employee::where('user_id', Auth::user()->id)->firstOrFail();
        $leaveBalances = LeaveBalance::where('employee_id',$emp->id)->get();

        return view('employees.apply')->with(['employee' => $emp, 'balances' => $leaveBalances]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function update_leave($id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $leaveRequest = LeaveRequest::findOrFail($id);

        return view('employees.update')->with(['leaveRequest' => $leaveRequest]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $credentialsData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        $credentialsData['password'] = Hash::make($request->password);
        $credentialsData['role'] = 'employee';

        $user = User::create($credentialsData);


        $validated = $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:employees',
           'mobile' => 'required|string|max:255',
        ]);

        $validated['user_id'] = $user->id;

        $employee = Employee::create($validated);

        // Get all leave types
        $leaveTypes = LeaveType::all();

        foreach ($leaveTypes as $leaveType) {
            // Create a new leave balance record for each leave type
            LeaveBalance::create([
                'employee_id' => $employee->id,
                'leave_type_id' => $leaveType->id,
                'remaining_days' => $leaveType->days_per_year / 12,
                'days_taken' => 0
            ]);
        }

        return redirect()->route('employees.show', compact('employee'))->with('success', 'Employee added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {

        $pendingLeaveRequests = LeaveRequest::where('status','pending')->where('employee_id', $employee->id)->get();
        $leaveRequests = LeaveRequest::where('status', '!=', 'pending')->where('employee_id', $employee->id)->paginate(10);
        $leaveBalances = LeaveBalance::where('employee_id',$employee->id)->get();

        return view('employees.show', compact('employee', 'leaveBalances', 'leaveRequests', 'pendingLeaveRequests'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'mobile' => 'required|string|max:255',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
