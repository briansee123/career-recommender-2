<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    /**
     * Show the resume builder page
     */
    public function show()
    {
        return view('user.buildresume');
    }

    /**
     * Save or update resume
     */
    public function save(Request $request)
    {
        try {
            $validated = $request->validate([
                'job_title' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'country' => 'nullable|string|max:255',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'summary' => 'nullable|string',
                'experience_company' => 'nullable|string|max:255',
                'experience_title' => 'nullable|string|max:255',
                'experience_duration' => 'nullable|string|max:255',
                'experience_description' => 'nullable|string',
                'education_institution' => 'nullable|string|max:255',
                'education_degree' => 'nullable|string|max:255',
                'education_year' => 'nullable|string|max:255',
                'skills' => 'nullable|string',
            ]);

            // Handle photo upload
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('resumes/photos', 'public');
                $validated['photo'] = $path;
            }

            // IMPORTANT: Add user_id to validated data
            $validated['user_id'] = auth()->id();

            // Find existing resume or create new one
            $resume = Resume::updateOrCreate(
                ['user_id' => auth()->id()],
                $validated
            );

            return response()->json([
                'success' => true,
                'message' => 'Resume saved successfully!',
                'resume' => $resume
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            \Log::error('Resume save error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error saving resume. Please try again.'
            ], 500);
        }
    }

    /**
     * Download resume as PDF (future enhancement)
     */
    public function download()
    {
        $resume = auth()->user()->resume;
        
        if (!$resume) {
            return redirect()->back()->with('error', 'No resume found. Please create one first.');
        }

        // TODO: Implement PDF generation
        // For now, just redirect back
        return redirect()->back()->with('info', 'PDF download feature coming soon!');
    }
}