<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application|RedirectResponse
    {
        if (auth()->user()->isAdmin()) {
            $leaveTypes = LeaveType::all();

            if ($leaveTypes->isEmpty()) {
                return redirect()->route('initial');
            }

            $leaveRequestsCount = LeaveRequest::where('status','pending')->count();
            $employeesCount = Employee::count();

            // Replace with your actual dashboard view
            return view('dashboard')->with([
                'employees' => $employeesCount,
                'leaveRequestCount' => $leaveRequestsCount
            ]);

        }

//        get employee record
        $emp = Employee::where('user_id', Auth::user()->id)->firstOrFail();

        $leaveRequests = LeaveRequest::where('employee_id', $emp->id)->paginate(10);
        $leaveBalances = LeaveBalance::where('employee_id',$emp->id)->get();

        // Redirect non-admins to their home page

        return view('dashboard')->with([
            'leaveRequests' => $leaveRequests,
            'leaveBalances' => $leaveBalances
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
