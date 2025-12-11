<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\JobListing;
use App\Models\JobApplication;
use App\Models\TestResult;
use App\Models\TestQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::where('is_admin', 0)->count();
        $totalJobs = JobListing::count();
        $totalApplications = JobApplication::count();
        $testsTaken = TestResult::count();
        
        $newUsersThisMonth = User::where('is_admin', 0)
            ->whereMonth('created_at', now()->month)
            ->count();
        
        $applicationsThisWeek = JobApplication::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->count();
        
        $activeUsersToday = User::where('is_admin', 0)
            ->whereDate('updated_at', today())
            ->count();
        
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalJobs',
            'totalApplications',
            'testsTaken',
            'newUsersThisMonth',
            'applicationsThisWeek',
            'activeUsersToday'
        ));
    }

    public function users()
    {
        $users = User::where('is_admin', 0)->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.users', compact('users'));
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'is_admin' => 'required|boolean'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->is_admin,
            'status' => 'active'
        ]);

        return response()->json(['success' => true]);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        // Prevent deleting admin accounts
        if ($user->is_admin) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete admin accounts!'
            ], 403);
        }
        
        $user->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ]);
    }

    public function jobs()
{
    $jobs = JobListing::orderBy('created_at', 'desc')->paginate(10);
    return view('admin.jobs', compact('jobs'));
}

    public function createJob(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary_min' => 'nullable|numeric',
            'salary_max' => 'nullable|numeric',
            'job_type' => 'required|string',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'status' => 'required|in:active,inactive,blocked'
        ]);

        JobListing::create($request->all());

        return response()->json(['success' => true]);
    }

    public function updateJob(Request $request, $id)
    {
        $job = JobListing::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary_min' => 'nullable|numeric',
            'salary_max' => 'nullable|numeric',
            'job_type' => 'required|string',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'status' => 'required|in:active,inactive,blocked'
        ]);

        $job->update($request->all());

        return response()->json(['success' => true]);
    }

    public function deleteJob($id)
    {
        $job = JobListing::findOrFail($id);
        $job->delete();

        return response()->json(['success' => true]);
    }

    public function questions()
    {
        $questions = TestQuestion::active()->ordered()->get();
        return view('admin.questions', compact('questions'));
    }

    public function updateQuestions(Request $request)
    {
        $questions = $request->questions;
        
        foreach ($questions as $q) {
            TestQuestion::where('id', $q['id'])->update([
                'question' => $q['question']
            ]);
        }
        
        return response()->json(['success' => true]);
    }

    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'avatar' => 'nullable|string|max:10'
        ]);

        $user->update($request->only(['name', 'email', 'avatar']));

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
    }
}   