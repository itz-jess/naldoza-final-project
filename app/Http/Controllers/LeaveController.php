<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // DISPLAY LEAVE REQUESTS WITH FILTERS
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $query = Leave::with(['employee', 'approver']);
        
        if ($user->isAdmin() || $user->isHrManager()) {
            $query->filter($request->all());
            $leaves = $query->latest()->paginate(15);
        } else {
            $employee = $user->employee;
            if ($employee) {
                $leaves = $query->where('employee_id', $employee->id)
                               ->filter($request->all())
                               ->latest()
                               ->paginate(15);
            } else {
                $leaves = collect([]);
            }
        }
        
        // Summary statistics for HR/Admin dashboard
        $summary = [
            'pending' => Leave::where('status', 'pending')->count(),
            'approved' => Leave::where('status', 'approved')->count(),
            'rejected' => Leave::where('status', 'rejected')->count(),
            'total_days' => Leave::where('status', 'approved')->sum('days_taken'),
        ];
        
        return view('leaves.index', compact('leaves', 'summary'));
    }

    // SHOW CREATE FORM
    public function create()
    {
        $employee = Auth::user()->employee;
        
        if (!$employee) {
            return redirect()->route('dashboard')->with('error', 'No employee record found.');
        }
        
        $remainingCredits = $employee->getRemainingLeaveCredits();
        
        return view('leaves.create', compact('remainingCredits'));
    }

    // SUBMIT LEAVE REQUEST
    public function store(Request $request)
    {
        $employee = Auth::user()->employee;
        
        if (!$employee) {
            return redirect()->back()->with('error', 'No employee record found.');
        }
        
        $request->validate([
            'leave_type' => 'required|in:sick,vacation,emergency,maternity,paternity,unpaid',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string',
        ]);
        
        $start = new \DateTime($request->start_date);
        $end = new \DateTime($request->end_date);
        $daysTaken = $start->diff($end)->days + 1;
        
        if ($request->leave_type != 'unpaid') {
            $remaining = $employee->getRemainingLeaveCredits();
            if ($daysTaken > $remaining) {
                return redirect()->back()->with('error', "Insufficient leave credits. Available: {$remaining} days");
            }
        }
        
        Leave::create([
            'employee_id' => $employee->id,
            'leave_type' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'days_taken' => $daysTaken,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);
        
        return redirect()->route('leaves.index')->with('success', 'Leave request submitted for approval.');
    }

    // APPROVE LEAVE
    public function approve(Leave $leave)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isHrManager()) {
            abort(403);
        }
        
        $leave->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);
        
        $employee = $leave->employee;
        if ($leave->leave_type != 'unpaid') {
            $employee->decrement('leave_credits', $leave->days_taken);
        }
        
        return redirect()->back()->with('success', 'Leave approved.');
    }

    // REJECT LEAVE
    public function reject(Leave $leave)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isHrManager()) {
            abort(403);
        }
        
        $leave->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);
        
        return redirect()->back()->with('success', 'Leave rejected.');
    }
}