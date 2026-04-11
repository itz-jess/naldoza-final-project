<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController; // Added for Employee CRUD
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// RBAC Dashboard Redirect
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('client.dashboard');
    })->name('dashboard');

});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

});

// Client routes
Route::middleware(['auth', 'role:client'])->group(function () {

    Route::get('/client/dashboard', function () {
        return view('client.dashboard');
    })->name('client.dashboard');

});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Employee CRUD routes
Route::middleware(['auth'])->group(function () {

    // All users can view the employees list
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

    // Admin-only CRUD actions
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
        Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
        Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
        Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    });
});

require __DIR__.'/auth.php';