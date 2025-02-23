<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeDocumentsController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanTypeController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Department Resource
    Route::resource('/department', DepartmentController::class);
    Route::resource('/designation', DesignationController::class);
    Route::resource('/employee', EmployeeController::class);
    Route::resource('/document', EmployeeDocumentsController::class);
    Route::resource('leave-types', LeaveTypeController::class);
    Route::resource('leaves', LeaveController::class);
    Route::get('/leave/{id}/{status}', [LeaveController::class, 'statusChange'])->name('leave.statusChange');
    Route::resource('loan-types', LoanTypeController::class);
    Route::resource('loans', LoanController::class);

    // AjaxController
    Route::controller(AjaxController::class)->group(function () {
        Route::get('/get-designations', [AjaxController::class, 'getDesignations']);
        Route::get('/get-leaves/{id}', [AjaxController::class, 'getLeaves']);
    });
});

require __DIR__.'/auth.php';
