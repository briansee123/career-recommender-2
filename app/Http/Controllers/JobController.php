<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function homepage()
{
    $jobs = JobListing::where('status', 'active')
        ->orderBy('created_at', 'desc')
        ->limit(6)
        ->get();
    
    return view('user.homepage', ['featuredJobs' => $jobs]);  // ← NEW
}

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
    
    // Salary filter
    if ($request->filled('min_salary')) {
        $query->where('salary_min', '>=', $request->min_salary);
    }
    
    // Job type filter
    if ($request->filled('job_type')) {
        $query->where('job_type', $request->job_type);
    }
    
    // Date posted filter
    if ($request->filled('date_posted')) {
        $days = [
            'today' => 1,
            'week' => 7,
            'month' => 30
        ];
        if (isset($days[$request->date_posted])) {
            $query->where('created_at', '>=', now()->subDays($days[$request->date_posted]));
        }
    }
    
    // Location filter
    if ($request->filled('location')) {
        $query->where('location', 'like', "%{$request->location}%");
    }
    
    $jobs = $query->orderBy('created_at', 'desc')->paginate(12);
    
    return view('user.jobs', compact('jobs'));
}

    public function apply(Request $request)
    {
        $request->validate([
            'job_listing_id' => 'required|exists:job_listings,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
        ]);

        $data = [
            'user_id' => auth()->id(),
            'job_listing_id' => $request->job_listing_id,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => 'pending'
        ];

        if ($request->hasFile('resume')) {
            $path = $request->file('resume')->store('resumes', 'public');
            $data['resume_path'] = $path;
        }

        JobApplication::create($data);

        return redirect()->route('homepage')->with('success', 'Application submitted successfully!');
    }
}