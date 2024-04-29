<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveBalance;
use App\Models\LeaveType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaveTypes = LeaveType::all();
        return view('leave_types.index', compact('leaveTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('leave_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:leave_types|max:255',
            'days_per_year' => 'required|numeric|min:1|max:100',
        ]);

        $leaveType = LeaveType::create($validatedData);

//        loop through all employess and create a balance for this new leave type
        $employees = Employee::all();

        foreach ($employees as $employee)
        {
            LeaveBalance::create([
                'employee_id' => $employee->id,
                'leave_type_id' => $leaveType->id,
                'remaining_days' => $leaveType->days_per_year / 12,
                'days_taken' => 0
            ]);
        }

        return redirect()->route('leave-types.index')->with('success', 'Leave Type created successfully.');
    }

    public function initial(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:leave_types|max:255',
            'days_per_year' => 'required|numeric|min:1|max:100',
        ]);

        LeaveType::create($validatedData);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaveType $leaveType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveType $leaveType)
    {

        return view('leave_types.edit', compact('leaveType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeaveType $leaveType)
    {

        $request->validate([
            'name' => 'required|max:255',
            'days_per_year' => 'required|numeric|min:1|max:100',
        ]);

        $leaveType->update($request->all());
        return redirect()->route('leave-types.index')->with('success', 'Leave Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveType $leaveType)
    {
        $leaveType->delete();
        return redirect()->route('leave-types.index')->with('success', 'Leave Type deleted successfully.');
    }
}
