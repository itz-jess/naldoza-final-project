<?php

namespace App\Http\Controllers;

use App\Models\JobPosition;
use App\Models\JobApplication;
use App\Services\HiringService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecruitmentController extends Controller
{
    protected $hiringService;

    public function __construct(HiringService $hiringService)
    {
        $this->middleware('auth');
        $this->hiringService = $hiringService;
    }

    // PUBLIC: View all job openings (No login required)
    public function jobOpenings()
    {
        $positions = JobPosition::where('is_active', true)->get();
        return view('recruitment.jobs', compact('positions'));
    }

    // PUBLIC: Show application form for a specific job
    public function applyForm(JobPosition $position)
    {
        return view('recruitment.apply', compact('position'));
    }

    // PUBLIC: Submit application with file uploads
    public function submitApplication(Request $request, JobPosition $position)
    {
        $request->validate([
            'applicant_name' => 'required|string|max:255',
            'email' => 'required|email',
            'age' => 'required|integer|min:18|max:100',
            'sex' => 'required|in:male,female,other',
            'contact_number' => 'required|string|max:20',
            'address' => 'required|string',
            'skills' => 'required|string',
            'experience' => 'nullable|string',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $resumePath = null;
        $profilePicturePath = null;

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }

        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        JobApplication::create([
            'job_position_id' => $position->id,
            'applicant_name' => $request->applicant_name,
            'email' => $request->email,
            'age' => $request->age,
            'sex' => $request->sex,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
            'skills' => $request->skills,
            'experience' => $request->experience,
            'resume_file' => $resumePath,
            'profile_picture' => $profilePicturePath,
            'status' => 'pending',
        ]);

        return redirect()->route('jobs.openings')->with('success', 'Application submitted successfully! We will contact you soon.');
    }

    // HR/ADMIN: View all applications with filters
    public function applications(Request $request)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isHrManager()) {
            abort(403, 'Unauthorized access.');
        }

        $query = JobApplication::with('jobPosition');

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('applicant_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('job_position_id')) {
            $query->where('job_position_id', $request->job_position_id);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $applications = $query->latest()->paginate(15);
        $positions = JobPosition::all();

        return view('recruitment.applications', compact('applications', 'positions'));
    }

    // HR/ADMIN: Update application status
    public function updateStatus(Request $request, JobApplication $application)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isHrManager()) {
            abort(403, 'Unauthorized access.');
        }

        $status = $request->status;
        
        $application->update([
            'status' => $status,
            'rejected_at' => $status === 'rejected' ? now() : null,
        ]);

        $message = $status === 'hired' ? 'Applicant marked as hired!' : 
                  ($status === 'rejected' ? 'Applicant rejected and moved to archive.' : 
                  'Application status updated.');

        return redirect()->back()->with('success', $message);
    }

    // NEW: Hire an applicant (converts to employee)
    public function hire(JobApplication $application)
    {
        // Check if user is Admin or HR Manager
        if (!Auth::user()->isAdmin() && !Auth::user()->isHrManager()) {
            abort(403, 'Unauthorized access.');
        }

        // Check if applicant has been interviewed
        if ($application->status !== 'interviewed') {
            return redirect()->back()->with('error', 'Applicant must be interviewed first before hiring.');
        }

        // Check if already converted to employee
        if ($application->isConvertedToEmployee()) {
            return redirect()->back()->with('error', 'This applicant has already been converted to an employee.');
        }

        try {
            // Convert applicant to employee using the HiringService
            $employee = $this->hiringService->convertToEmployee($application);
            
            return redirect()->route('employees.show', $employee)
                ->with('success', "{$application->applicant_name} has been hired! Temporary password: password123");
                
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}