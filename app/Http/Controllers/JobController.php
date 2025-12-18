<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    // --- 1. HOMEPAGE LOGIC ---
    public function homepage()
    {
        // Fetch latest 6 active jobs for the homepage
        $featuredJobs = JobListing::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
        
        // Pass them as 'featuredJobs' to match the View
        return view('user.homepage', compact('featuredJobs'));
    }

    // --- 2. ALL JOBS PAGE LOGIC ---
    public function index(Request $request)
    {
        $query = JobListing::where('status', 'active');
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }
        
        // Filters
        if ($request->filled('min_salary')) {
            $query->where('salary_min', '>=', $request->min_salary);
        }
        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }
        if ($request->filled('date_posted')) {
            $days = ['today' => 1, 'week' => 7, 'month' => 30];
            if (isset($days[$request->date_posted])) {
                $query->where('created_at', '>=', now()->subDays($days[$request->date_posted]));
            }
        }
        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }
        
        $jobs = $query->orderBy('created_at', 'desc')->paginate(12);
        
        return view('user.jobs', compact('jobs'));
    }

    // --- 3. SHOW APPLY FORM ---
    public function showApply(Request $request)
    {
        $jobId = $request->query('job_id');
        $job = null;
        
        if ($jobId) {
            $job = JobListing::find($jobId);
        }
        
        // Fallback if job not found
        if (!$job) {
            $job = (object)[
                'id' => null,
                'title' => 'General Application',
                'company' => 'Job Partner'
            ];
        }
        
        return view('user.apply', compact('job'));
    }

    // --- 4. HANDLE APPLICATION SUBMISSION (With Smart Resume Logic) ---
    public function apply(Request $request)
    {
        $request->validate([
            'job_id' => 'nullable|exists:job_listings,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            // Resume is nullable because user might use existing file
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'use_existing_resume' => 'nullable|boolean'
        ]);

        $resumePath = null;

        // Logic: Did they upload a new one, or choose the existing one?
        if ($request->hasFile('resume')) {
            // Case A: New File Uploaded
            $resumePath = $request->file('resume')->store('resumes', 'public');
        } elseif ($request->input('use_existing_resume') == '1' && Auth::user()->resume_path) {
            // Case B: User checked "Use Profile Resume"
            $resumePath = Auth::user()->resume_path;
        }

        JobApplication::create([
            'user_id' => Auth::id(),
            'job_listing_id' => $request->job_id ?? null,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'resume_path' => $resumePath, // Saves the path (new or existing)
            'status' => 'pending'
        ]);

        return redirect()->route('jobs')->with('success', 'Application submitted successfully!');
    }
}