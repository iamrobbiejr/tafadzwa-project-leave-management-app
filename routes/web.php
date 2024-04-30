<?php

use App\Http\Controllers\DashController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\LeaveBalanceController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/initial', function (){
   return view('initial');
})->name('initial');

Route::post('/initial', [LeaveTypeController::class, 'initial'])->name('initial.store');

Route::get('/dashboard', [DashController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('employees', EmployeeController::class);
    Route::resource('leave-types', LeaveTypeController::class);
    Route::resource('leave-balance', LeaveBalanceController::class);
    Route::resource('leave-requests', LeaveRequestController::class);
    Route::get('/apply', [EmployeeController::class, 'apply'])->name('apply');
    Route::get('/update/{id}', [EmployeeController::class, 'update_leave'])->name('update_leave');
    Route::post('/filter', [LeaveBalanceController::class, 'filter'])->name('filter');

    Route::put('/approve/{id}', [LeaveRequestController::class, 'approve'])->name('approve');
    Route::put('/reject/{id}', [LeaveRequestController::class, 'reject'])->name('reject');

});

require __DIR__.'/auth.php';
