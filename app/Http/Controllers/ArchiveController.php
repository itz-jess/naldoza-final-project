<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobPosition;  // ← ADD THIS LINE
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArchiveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Remove the role middleware from constructor - we'll check in methods instead
    }

    // View rejected applications (archive) with filters
    public function rejectedApplications(Request $request)
    {
        // Check if user is Admin or HR Manager
        if (!Auth::user()->isAdmin() && !Auth::user()->isHrManager()) {
            abort(403, 'Unauthorized access.');
        }

        $query = JobApplication::where('status', 'rejected')
            ->with('jobPosition');

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('applicant_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('job_position_id')) {
            $query->where('job_position_id', $request->job_position_id);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('rejected_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('rejected_at', '<=', $request->date_to);
        }

        $rejected = $query->latest('rejected_at')->paginate(15);
        $positions = JobPosition::all();

        return view('archive.rejected', compact('rejected', 'positions'));
    }

    // Restore rejected application
    public function restore($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isHrManager()) {
            abort(403, 'Unauthorized access.');
        }

        $application = JobApplication::findOrFail($id);
        $application->update([
            'status' => 'pending',
            'rejected_at' => null,
        ]);
        
        return redirect()->back()->with('success', 'Application restored from archive.');
    }

    // Permanently delete from archive
    public function permanentDelete($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isHrManager()) {
            abort(403, 'Unauthorized access.');
        }

        $application = JobApplication::findOrFail($id);
        $application->forceDelete();
        
        return redirect()->back()->with('success', 'Application permanently deleted from archive.');
    }
}