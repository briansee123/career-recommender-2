<?php

namespace App\Http\Controllers;

use App\Models\TestResult;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $testHistory = TestResult::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        $applications = JobApplication::where('user_id', $user->id)
            ->with('jobListing')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('user.profile', compact('user', 'testHistory', 'applications'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'age' => 'nullable|string|max:50',
            'nationality' => 'nullable|string|max:100',
            'avatar' => 'nullable|string|max:10'
        ]);

        $user->update($request->only(['name', 'email', 'phone', 'age', 'nationality', 'avatar']));

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    public function uploadResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120'
        ]);

        $user = auth()->user();
        
        // Delete old resume if exists
        if ($user->resume_path && Storage::exists('public/' . $user->resume_path)) {
            Storage::delete('public/' . $user->resume_path);
        }
        
        // Store new resume
        $path = $request->file('resume')->store('resumes', 'public');
        
        $user->update(['resume_path' => $path]);
        
        return redirect()->route('profile')->with('success', 'Resume uploaded successfully!');
    }

    public function deleteApplication($id)
    {
        $application = JobApplication::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        
        $application->delete();
        
        return redirect()->route('profile')->with('success', 'Application deleted successfully!');
    }
}