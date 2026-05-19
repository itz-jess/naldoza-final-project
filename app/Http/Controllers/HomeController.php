<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return view('welcome');
        }
        
        $user = Auth::user();
        
        // ADMIN DASHBOARD
        if ($user->isAdmin()) {
            $stats = [
                'total_employees' => Employee::count(),
                'present_today' => Attendance::where('date', today())->count(),
                'pending_leaves' => Leave::where('status', 'pending')->count(),
                'total_departments' => Employee::distinct('department')->count('department'),
            ];
            
            $recentEmployees = Employee::latest()->take(5)->get();
            $pendingLeaves = Leave::with('employee')->where('status', 'pending')->latest()->take(5)->get();
            
            return view('admin.dashboard', compact('stats', 'recentEmployees', 'pendingLeaves'));
        }
        
        // HR MANAGER DASHBOARD
        if ($user->isHrManager()) {
            $stats = [
                'total_employees' => Employee::count(),
                'present_today' => Attendance::where('date', today())->count(),
                'pending_leaves' => Leave::where('status', 'pending')->count(),
                'total_departments' => Employee::distinct('department')->count('department'),
            ];
            
            $recentEmployees = Employee::latest()->take(5)->get();
            $pendingLeaves = Leave::with('employee')->where('status', 'pending')->latest()->take(5)->get();
            
            return view('hr.dashboard', compact('stats', 'recentEmployees', 'pendingLeaves'));
        }
        
        // EMPLOYEE DASHBOARD
        $employee = $user->employee;
        
        if (!$employee) {
            return view('employee.dashboard')->with('error', 'No employee record found. Contact HR.');
        }
        
        $stats = [
            'my_attendance' => $employee->attendances()->whereMonth('date', now()->month)->count(),
            'my_leaves' => $employee->leaves()->whereYear('start_date', now()->year)->count(),
            'pending_requests' => $employee->leaves()->where('status', 'pending')->count(),
            'remaining_credits' => $employee->getRemainingLeaveCredits(),
        ];
        
        $recentAttendance = $employee->attendances()->latest('date')->take(5)->get();
        $recentLeaves = $employee->leaves()->latest()->take(5)->get();
        
        return view('employee.dashboard', compact('stats', 'recentAttendance', 'recentLeaves'));
    }
}