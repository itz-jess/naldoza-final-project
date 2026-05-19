<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\ArchiveController;
use Illuminate\Support\Facades\Route;

// WELCOME PAGE
Route::get('/', [HomeController::class, 'index'])->name('home');

// PUBLIC RECRUITMENT ROUTES (No login required)
Route::get('/careers', [RecruitmentController::class, 'jobOpenings'])->name('jobs.openings');
Route::get('/careers/{position}/apply', [RecruitmentController::class, 'applyForm'])->name('jobs.apply');
Route::post('/careers/{position}/apply', [RecruitmentController::class, 'submitApplication'])->name('jobs.submit');

// AUTHENTICATED ROUTES
Route::middleware('auth')->group(function () {
    
    // DASHBOARD
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // PROFILE ROUTES
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // EMPLOYEE CRUD ROUTES
    Route::resource('employees', EmployeeController::class);
    
    // EMPLOYEE ADDITIONAL ROUTES
    Route::patch('/employees/{employee}/approve', [EmployeeController::class, 'approve'])->name('employees.approve');
    Route::delete('/employees/{employee}/reject', [EmployeeController::class, 'reject'])->name('employees.reject');
    Route::patch('/employees/{employee}/promote', [EmployeeController::class, 'promoteToHR'])->name('employees.promote');
    Route::patch('/employees/{id}/restore', [EmployeeController::class, 'restore'])->name('employees.restore');

    // ATTENDANCE ROUTES
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance/time-in', [AttendanceController::class, 'timeIn'])->name('attendance.timeIn');
    Route::post('/attendance/time-out', [AttendanceController::class, 'timeOut'])->name('attendance.timeOut');

    // LEAVE ROUTES
    Route::resource('leaves', LeaveController::class);
    Route::patch('/leaves/{leave}/approve', [LeaveController::class, 'approve'])->name('leaves.approve');
    Route::patch('/leaves/{leave}/reject', [LeaveController::class, 'reject'])->name('leaves.reject');

    // RECRUITMENT ROUTES (HR/Admin only)
    Route::get('/recruitment/applications', [RecruitmentController::class, 'applications'])->name('recruitment.applications');
    Route::patch('/recruitment/{application}/status', [RecruitmentController::class, 'updateStatus'])->name('recruitment.update-status');
    // Hire applicant route
    Route::post('/recruitment/{application}/hire', [RecruitmentController::class, 'hire'])->name('recruitment.hire'); 

    // ARCHIVE ROUTES
    Route::get('/archive/rejected', [ArchiveController::class, 'rejectedApplications'])->name('archive.rejected');
    Route::patch('/archive/{id}/restore', [ArchiveController::class, 'restore'])->name('archive.restore');
    Route::delete('/archive/{id}/permanent', [ArchiveController::class, 'permanentDelete'])->name('archive.permanent-delete');

});

// LARAVEL BREEZE AUTH ROUTES
require __DIR__.'/auth.php';