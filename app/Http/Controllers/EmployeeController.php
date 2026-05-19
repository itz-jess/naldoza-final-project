<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class EmployeeController extends Controller
{
    // DISPLAY EMPLOYEE LIST (WITH FILTERS)
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // ADMIN or HR MANAGER - see all employees with filters
        if ($user->isAdmin() || $user->isHrManager()) {
            $employees = Employee::filter($request->all())
                                ->latest()
                                ->paginate(10);
        } 
        // EMPLOYEE - see only their own record
        else {
            $employee = $user->employee;
            if ($employee) {
                $employees = collect([$employee]);
                // Convert to paginator for consistency
                $employees = new LengthAwarePaginator(
                    $employees, 
                    1, 
                    10, 
                    1, 
                    ['path' => route('employees.index')]
                );
            } else {
                $employees = collect([]);
                $employees = new LengthAwarePaginator(
                    [], 
                    0, 
                    10, 
                    1, 
                    ['path' => route('employees.index')]
                );
            }
        }
        
        return view('employees.index', compact('employees'));
    }

    // SHOW CREATE FORM
    public function create()
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isHrManager()) {
            abort(403, 'Only Admin/HR can add employees.');
        }
        return view('employees.create');
    }

    // SAVE NEW EMPLOYEE
    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isHrManager()) {
            abort(403, 'Only Admin/HR can add employees.');
        }

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'position' => 'required|string|max:255',
            'department' => 'required|string',
            'salary' => 'required|numeric|min:0',
            'hire_date' => 'required|date',
            'address' => 'nullable|string',
            'contact_number' => 'nullable|string',
            'skills' => 'nullable|string',
        ]);

        // Create user account
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make('password123'),
            'role' => 'employee',
        ]);

        // Create employee record
        Employee::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'position' => $request->position,
            'department' => $request->department,
            'salary' => $request->salary,
            'hire_date' => $request->hire_date,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'skills' => $request->skills,
            'is_active' => true,
            'approved_at' => now(),
            'approved_by' => auth()->id(),
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee created! Password: password123');
    }

    // SHOW EMPLOYEE DETAILS (With Tabs)
    public function show(Employee $employee)
    {
        $employee->load(['attendances', 'leaves', 'performances', 'seminars', 'trainings', 'user']);
        
        $stats = [
            'total_attendance' => $employee->attendances->count(),
            'pending_leaves' => $employee->leaves->where('status', 'pending')->count(),
            'approved_leaves' => $employee->leaves->where('status', 'approved')->count(),
            'avg_performance' => round($employee->performances->avg('rating') ?? 0, 1),
            'remaining_credits' => $employee->getRemainingLeaveCredits(),
        ];
        
        return view('employees.show', compact('employee', 'stats'));
    }

    // SHOW EDIT FORM
    public function edit(Employee $employee)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isHrManager()) {
            abort(403, 'Only Admin/HR can edit employees.');
        }
        return view('employees.edit', compact('employee'));
    }

    // UPDATE EMPLOYEE
    public function update(Request $request, Employee $employee)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isHrManager()) {
            abort(403, 'Only Admin/HR can edit employees.');
        }

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'position' => 'required|string|max:255',
            'department' => 'required|string',
            'salary' => 'required|numeric|min:0',
            'address' => 'nullable|string',
            'contact_number' => 'nullable|string',
            'skills' => 'nullable|string',
        ]);

        $employee->update($request->except(['_token', '_method']));
        
        // Update user name
        if ($employee->user) {
            $employee->user->update([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
            ]);
        }

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    // ARCHIVE EMPLOYEE (Soft Delete - NO actual deletion)
    public function destroy(Employee $employee)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isHrManager()) {
            abort(403, 'Only Admin/HR can archive employees.');
        }

        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee archived successfully!');
    }

    // APPROVE PENDING EMPLOYEE
    public function approve(Employee $employee)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isHrManager()) {
            abort(403);
        }

        $employee->update([
            'is_active' => true,
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee approved successfully!');
    }

    // REJECT PENDING EMPLOYEE
    public function reject(Employee $employee)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isHrManager()) {
            abort(403);
        }

        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee rejected and removed.');
    }

    // PROMOTE TO HR MANAGER (Admin only)
    public function promoteToHR(Employee $employee)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Only Admin can promote employees.');
        }
        
        if ($employee->user) {
            $employee->user->update(['role' => 'hr_manager']);
            return redirect()->route('employees.show', $employee)->with('success', 'Employee promoted to HR Manager!');
        }
        
        return redirect()->route('employees.show', $employee)->with('error', 'User account not found.');
    }

    // RESTORE ARCHIVED EMPLOYEE
    public function restore($id)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isHrManager()) {
            abort(403);
        }
        
        $employee = Employee::withTrashed()->findOrFail($id);
        $employee->restore();
        
        return redirect()->route('employees.index')->with('success', 'Employee restored successfully!');
    }
}