<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    // DISPLAY EMPLOYEE LIST (WITH SEARCH)
    public function index(Request $request)
    {
        $query = Employee::query();
        
        // SEARCH FUNCTIONALITY
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('position', 'like', "%{$search}%");
            });
        }
        
        // ROLE-BASED VIEWING
        if (auth()->check() && auth()->user()->isAdmin()) {
            // Admin sees ALL employees (including pending)
            $employees = $query->latest()->paginate(10);
        } else {
            // Non-admin sees ONLY approved employees
            $employees = $query->approved()->latest()->paginate(10);
        }
        
        return view('employees.index', compact('employees'));
    }

    // SHOW CREATE FORM
    public function create()
    {
        return view('employees.create');
    }

    // SAVE NEW EMPLOYEE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
        ]);

        $employee = Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'salary' => $request->salary,
            'is_active' => false, // PENDING APPROVAL
        ]);

        $message = (auth()->check() && auth()->user()->isAdmin()) 
            ? 'Employee created successfully!' 
            : 'Employee submitted for admin approval.';

        return redirect()->route('employees.index')->with('success', $message);
    }

    // SHOW EDIT FORM (ADMIN ONLY)
    public function edit(Employee $employee)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Only admin can edit employee records.');
        }
        return view('employees.edit', compact('employee'));
    }

    // UPDATE EMPLOYEE (ADMIN ONLY)
    public function update(Request $request, Employee $employee)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Only admin can update employee records.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
        ]);

        $employee->update($request->only(['name', 'email', 'position', 'salary']));

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    // DELETE EMPLOYEE (ADMIN ONLY)
    public function destroy(Employee $employee)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Only admin can delete employee records.');
        }

        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }

    // APPROVE PENDING EMPLOYEE (ADMIN ONLY)
    public function approve(Employee $employee)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $employee->update([
            'is_active' => true,
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee approved successfully!');
    }

    // REJECT PENDING EMPLOYEE (ADMIN ONLY)
    public function reject(Employee $employee)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee application rejected and removed.');
    }
}