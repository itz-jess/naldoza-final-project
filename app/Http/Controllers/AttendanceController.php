<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // DISPLAY ATTENDANCE LIST
    public function index(Request $request)
{
    $query = Attendance::with('employee');
    
    // Apply filters
    if ($request->filled('search')) {
        $search = $request->search;
        $query->whereHas('employee', function($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }
    
    if ($request->filled('date_from')) {
        $query->whereDate('date', '>=', $request->date_from);
    }
    
    if ($request->filled('date_to')) {
        $query->whereDate('date', '<=', $request->date_to);
    }
    
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }
    
    if ($request->filled('employee_id') && (Auth::user()->isAdmin() || Auth::user()->isHrManager())) {
        $query->where('employee_id', $request->employee_id);
    }
    
    if (Auth::user()->isAdmin() || Auth::user()->isHrManager()) {
        $attendances = $query->latest('date')->paginate(15);
        $employees = Employee::all();
    } else {
        $employee = Auth::user()->employee;
        if ($employee) {
            $query->where('employee_id', $employee->id);
            $attendances = $query->latest('date')->paginate(15);
        } else {
            $attendances = collect([]);
        }
        $employees = [];
    }
    
    return view('attendance.index', compact('attendances', 'employees'));
}
    

    // TIME IN
    public function timeIn()
    {
        $employee = Auth::user()->employee;
        
        if (!$employee) {
            return redirect()->back()->with('error', 'No employee record found.');
        }
        
        $existing = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', today())
            ->first();
        
        if ($existing) {
            return redirect()->back()->with('error', 'Already timed in today.');
        }
        
        // Use Asia/Manila timezone (Philippines)
        $currentTime = now('Asia/Manila');
        $status = $currentTime->format('H:i') > '08:30' ? 'late' : 'present';
        
        Attendance::create([
            'employee_id' => $employee->id,
            'date' => today('Asia/Manila'),
            'time_in' => $currentTime,
            'status' => $status,
        ]);
        
        $message = $status == 'late' ? 'Time in recorded (LATE)!' : 'Time in recorded!';
        return redirect()->back()->with('success', $message);
    }

    // TIME OUT
    public function timeOut()
    {
        $employee = Auth::user()->employee;
        
        if (!$employee) {
            return redirect()->back()->with('error', 'No employee record found.');
        }
        
        $attendance = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', today('Asia/Manila'))
            ->first();
        
        if (!$attendance) {
            return redirect()->back()->with('error', 'Please time in first.');
        }
        
        if ($attendance->time_out) {
            return redirect()->back()->with('error', 'Already timed out today.');
        }
        
        $attendance->update(['time_out' => now('Asia/Manila')]);
        
        return redirect()->back()->with('success', 'Time out recorded!');
    }

}