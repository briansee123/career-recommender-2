<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;

class JobController extends Controller
{
    // Show homepage with featured jobs
    public function homepage()
    {
        $jobs = JobListing::where('status', 'active')
                         ->where('is_available', true)
                         ->orderBy('posted_date', 'desc')
                         ->limit(6)
                         ->get();
        
        return view('user.homepage', compact('jobs'));
    }

    // Show all jobs
    public function index()
    {
        $jobs = JobListing::where('status', 'active')
                         ->where('is_available', true)
                         ->orderBy('posted_date', 'desc')
                         ->paginate(10);
        
        return view('user.jobs', compact('jobs'));
    }

    // Show apply page
    public function showApply(Request $request)
    {
        $jobId = $request->query('id');
        $job = JobListing::find($jobId);
        
        return view('user.apply', compact('job'));
    }

    // Handle job application
    public function apply(Request $request)
    {
        // We'll implement this later with file upload
        return back()->with('success', 'Application submitted!');
    }
}