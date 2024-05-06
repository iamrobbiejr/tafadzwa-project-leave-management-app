<?php

namespace App\Console\Commands;

use App\Models\Employee;
use App\Models\LeaveType;
use Illuminate\Console\Command;

class SimulateMonthEndLeaveAccrual extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'simulate:month-end-leave-accrual';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Simulates month end and calculates leave day accruals for employees.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Simulating Month End Leave Accrual...');

        // Get all leave types with accrual enabled
        $leaveTypes = LeaveType::all();

        // Loop through all employees
        foreach (Employee::all() as $employee) {
            $totalAccruedDays = 0;

            // Calculate accrual for each leave type
            foreach ($leaveTypes as $leaveType) {
                $daysToAccrue = $leaveType->days_per_year / 12;
                $totalAccruedDays += $daysToAccrue;

                // Update employee's leave balance for this type
                $employee->leaveBalances()->updateOrCreate(
                    ['leave_type_id' => $leaveType->id],
                    ['remaining_days' => $employee->leaveBalances->where('leave_type_id', $leaveType->id)->first()->remaining_days + $daysToAccrue]
                );
            }

            $this->info("Leave accrual for employee {$employee->name} done");
        }

        $this->info('Month End Leave Accrual Simulation Completed.');
        return 0;
    }
}
