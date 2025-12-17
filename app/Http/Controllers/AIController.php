<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AIController extends Controller
{
    protected $gemini;

    public function __construct(GeminiService $gemini)
    {
        $this->gemini = $gemini;
    }

    /**
     * Handle chatbot messages
     * Route: POST /ai/chat
     */
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500'
        ]);

        $message = $request->input('message');
        
        // Check for quick shortcuts
        $shortcuts = [
            'job' => 'Looking for jobs? Great! 🎯 Check out our <a href="/jobs">job listings</a> - there are amazing opportunities waiting for you!',
            'test' => 'Want to discover your perfect career? 💫 Take our <a href="/test">personality test</a> - it only takes 5 minutes!',
            'resume' => 'Ready to impress employers? ✨ Use our <a href="/buildresume">resume builder</a> to create a professional resume in minutes!',
            'help' => 'I\'m here to help! 💜 You can:<br>• Browse <a href="/jobs">jobs</a><br>• Take a <a href="/test">career test</a><br>• Build your <a href="/buildresume">resume</a><br>• View your <a href="/profile">profile</a>',
        ];

        foreach ($shortcuts as $keyword => $response) {
            if (stripos($message, $keyword) !== false) {
                return response()->json([
                    'success' => true,
                    'response' => $response
                ]);
            }
        }

        // Use AI for other messages
        $response = $this->gemini->chat($message);

        return response()->json([
            'success' => true,
            'response' => $response
        ]);
    }

    /**
     * Get profile encouragement message
     * Route: GET /ai/profile-encouragement
     */
    public function profileEncouragement()
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        $user = Auth::user();
        
        // Calculate profile completion
        $completion = $this->calculateProfileCompletion($user);
        
        // Check if user has resume
        $hasResume = \App\Models\Resume::where('user_id', $user->id)->exists();
        
        // Count applications
        $applicationCount = \App\Models\JobApplication::where('user_id', $user->id)->count();
        
        // Get AI encouragement
        $message = $this->gemini->getProfileEncouragement(
            $completion,
            $hasResume,
            $applicationCount
        );

        return response()->json([
            'success' => true,
            'message' => $message,
            'completion' => $completion,
            'hasResume' => $hasResume,
            'applicationCount' => $applicationCount
        ]);
    }

    /**
     * Analyze career test and return AI recommendations
     * Route: POST /ai/analyze-career-test
     */
    public function analyzeCareerTest(Request $request)
    {
        $request->validate([
            'mbti' => 'required|string|size:4',
            'skills' => 'required|string|max:200',
            'interests' => 'nullable|string|max:200',
            'academic' => 'required|string|max:100'
        ]);

        $mbti = $request->input('mbti');
        $skills = $request->input('skills');
        $interests = $request->input('interests', '');
        $academic = $request->input('academic');

        // Combine interests and academic into background
        $background = trim($interests . ' ' . $academic);

        // Get AI recommendations
        $recommendations = $this->gemini->analyzeCareerTest($mbti, $skills, $background);

        // Save test result if user is logged in
        if (Auth::check()) {
            \App\Models\TestResult::create([
                'user_id' => Auth::id(),
                'mbti_type' => $mbti,
                'skills' => $skills,
                'academic_background' => $academic,
                'recommendations' => $recommendations,
                'test_date' => now()
            ]);
        }

        return response()->json([
            'success' => true,
            'recommendations' => $recommendations,
            'mbti' => $mbti,
            'isLoggedIn' => Auth::check()
        ]);
    }

    /**
     * Calculate profile completion percentage
     */
    protected function calculateProfileCompletion($user)
    {
        $points = 0;
        $total = 6;

        // Name (1 point)
        if (!empty($user->name)) {
            $points++;
        }

        // Email (1 point)
        if (!empty($user->email)) {
            $points++;
        }

        // Resume (2 points - worth more!)
        if (\App\Models\Resume::where('user_id', $user->id)->exists()) {
            $points += 2;
        }

        // Test results (1 point)
        if (\App\Models\TestResult::where('user_id', $user->id)->exists()) {
            $points++;
        }

        // Job applications (1 point)
        if (\App\Models\JobApplication::where('user_id', $user->id)->exists()) {
            $points++;
        }

        return round(($points / $total) * 100);
    }
}