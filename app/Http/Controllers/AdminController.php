<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JobListing; // Uses the correct model
use App\Models\JobApplication;
use App\Models\TestResult;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        // 1. Basic Stats
        $totalUsers = User::where('is_admin', 0)->count();
        $totalJobs = JobListing::count();
        $totalApplications = JobApplication::count();
        $totalTests = TestResult::count();
        
        // 2. Growth Stats (Fixes the Undefined Variable error)
        $newUsersThisMonth = User::where('is_admin', 0)
            ->where('created_at', '>=', now()->subDays(30))
            ->count();
            
        $applicationsThisWeek = JobApplication::where('created_at', '>=', now()->subWeek())->count();
        $activeJobs = JobListing::where('status', 'active')->count();
        $activeUsersToday = User::whereDate('created_at', today())->count();
        
        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalJobs', 
            'totalApplications', 
            'totalTests',
            'newUsersThisMonth', // <--- variable passed here
            'applicationsThisWeek', 
            'activeJobs', 
            'activeUsersToday'
        ));
    }

    // --- Profile Management ---
    public function profile()
    {
        return view('admin.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'avatar' => 'nullable|string|max:10'
        ]);
        $user->update($request->all());
        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    // --- User Management ---
    public function users(Request $request)
    {
        $query = User::query();
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }
        $users = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'is_admin' => 'required|boolean'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // Model handles hashing
            'is_admin' => $request->is_admin,
            'status' => 'active'
        ]);

        return response()->json(['success' => true]);
    }

    public function deleteUser($id)
    {
        if (auth()->id() == $id) {
            return response()->json(['success' => false, 'message' => 'Cannot delete yourself'], 403);
        }
        User::destroy($id);
        return response()->json(['success' => true, 'message' => 'User deleted successfully']);
    }

    // --- Job Management ---
    public function jobs()
    {
        $jobs = JobListing::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.jobs', compact('jobs'));
    }

    public function createJob(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'job_type' => 'required',
            'status' => 'required',
            'description' => 'required',
            'salary_min' => 'nullable|numeric',
            'salary_max' => 'nullable|numeric',
        ]);
        
        $data['salary'] = ($request->salary_min && $request->salary_max) 
            ? "MYR {$request->salary_min} - {$request->salary_max}" 
            : 'Negotiable';

        JobListing::create($data);
        return redirect()->back()->with('success', 'Job created successfully');
    }

    public function updateJob(Request $request, $id)
    {
        $job = JobListing::findOrFail($id);
        $job->update($request->all());
        return redirect()->back()->with('success', 'Job updated successfully');
    }

    public function deleteJob($id)
    {
        JobListing::destroy($id);
        return redirect()->back()->with('success', 'Job deleted successfully');
    }
}