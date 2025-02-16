<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeDocumentsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeaveTypeController;
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

    // AjaxController
    Route::controller(AjaxController::class)->group(function () {
        Route::get('/get-designations', [AjaxController::class, 'getDesignations']);
    });
});

require __DIR__.'/auth.php';
