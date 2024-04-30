<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveBalance;
use App\Models\LeaveType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;



class LeaveBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        $leaveTypes = LeaveType::all();

        $leave_balances = LeaveBalance::paginate(10);
        return view('leave_balance.index', compact('leave_balances', 'leaveTypes', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function filter(Request $request): Factory|\Illuminate\Foundation\Application|View|RedirectResponse|Application
    {
        if ($request['employee_id'] && $request['leave_type_id']){

            $employees = Employee::all();
            $leaveTypes = LeaveType::all();

            $leave_balances = LeaveBalance::where('employee_id',$request['employee_id'])
                ->where('leave_type_id', $request['leave_type_id'])->paginate(10);

            return view('leave_balance.index', compact('leave_balances', 'leaveTypes', 'employees'));

        }

        if ($request['employee_id']){

            $employees = Employee::all();
            $leaveTypes = LeaveType::all();

            $leave_balances = LeaveBalance::where('employee_id',$request['employee_id'])
               ->paginate(10);
            return view('leave_balance.index', compact('leave_balances', 'leaveTypes', 'employees'));

        }

        if ($request['leave_type_id']){

            $employees = Employee::all();
            $leaveTypes = LeaveType::all();

            $leave_balances = LeaveBalance::where('leave_type_id', $request['leave_type_id'])->paginate(10);

            return view('leave_balance.index', compact('leave_balances', 'leaveTypes', 'employees'));

        }

        return redirect()->back()->with('error', 'Select at least one filter parameter');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(LeaveBalance $leaveBalance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveBalance $leaveBalance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeaveBalance $leaveBalance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveBalance $leaveBalance)
    {
        //
    }
}
