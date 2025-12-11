<?php

namespace App\Http\Controllers;

use App\Models\TestQuestion;
use App\Models\TestResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PersonalityTestController extends Controller
{
    public function showTest()
    {
        $questions = TestQuestion::active()->ordered()->get();
        return view('user.test', compact('questions'));
    }

    public function submitTest(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'skills' => 'required|string',
                'interests' => 'required|string',
                'academic' => 'required|string',
                'q1' => 'required|string|size:1',
                'q2' => 'required|string|size:1',
                'q3' => 'required|string|size:1',
                'q4' => 'required|string|size:1',
            ]);

            // Calculate MBTI type
            $mbtiType = $this->calculateMBTI([
                'q1' => $validated['q1'],
                'q2' => $validated['q2'],
                'q3' => $validated['q3'],
                'q4' => $validated['q4'],
            ]);

            // Get recommendations (using fallback system)
            $recommendations = $this->getRecommendations(
                $mbtiType,
                $validated['skills'],
                $validated['interests'],
                $validated['academic']
            );

            // Save to database
            $testResult = TestResult::create([
                'user_id' => Auth::id(),
                'mbti_type' => $mbtiType,
                'skills' => $validated['skills'],
                'interests' => $validated['interests'],
                'academic_background' => $validated['academic'],
                'personality_answers' => [
                    'q1' => $validated['q1'],
                    'q2' => $validated['q2'],
                    'q3' => $validated['q3'],
                    'q4' => $validated['q4'],
                ],
                'ai_recommendations' => $recommendations,
            ]);

            // Return JSON response for AJAX
            return response()->json([
                'success' => true,
                'mbti_type' => $mbtiType,
                'recommendations' => $recommendations,
                'message' => 'Test completed successfully!'
            ]);

        } catch (\Exception $e) {
            Log::error('Test submission error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error processing test. Please try again.'
            ], 500);
        }
    }

    private function calculateMBTI($answers)
    {
        // Q1: E (Extrovert) vs I (Introvert)
        $dimension1 = $answers['q1'];
        
        // Q2: S (Sensing) vs N (Intuition)
        $dimension2 = $answers['q2'];
        
        // Q3: T (Thinking) vs F (Feeling)
        $dimension3 = $answers['q3'];
        
        // Q4: J (Judging) vs P (Perceiving)
        $dimension4 = $answers['q4'];
        
        return $dimension1 . $dimension2 . $dimension3 . $dimension4;
    }

    private function getRecommendations($mbtiType, $skills, $interests, $academic)
    {
        // Comprehensive MBTI-based career recommendations
        $mbtiCareers = [
            'INTJ' => [
                'primary' => 'Data Scientist / Systems Architect',
                'secondary' => ['Software Engineer', 'Research Scientist', 'Strategic Planner'],
                'description' => 'Your analytical mind and strategic thinking make you perfect for roles involving complex problem-solving and system design.'
            ],
            'INTP' => [
                'primary' => 'Software Engineer / Research Analyst',
                'secondary' => ['Data Analyst', 'Architect', 'Academic Researcher'],
                'description' => 'Your logical approach and love for theoretical frameworks suit technical and research-oriented careers.'
            ],
            'ENTJ' => [
                'primary' => 'Executive / Project Manager',
                'secondary' => ['Business Consultant', 'Entrepreneur', 'Operations Manager'],
                'description' => 'Your leadership abilities and strategic vision are ideal for management and executive roles.'
            ],
            'ENTP' => [
                'primary' => 'Innovation Consultant / Entrepreneur',
                'secondary' => ['Product Manager', 'Business Developer', 'Marketing Strategist'],
                'description' => 'Your innovative thinking and adaptability excel in dynamic, entrepreneurial environments.'
            ],
            'INFJ' => [
                'primary' => 'Counselor / UX Researcher',
                'secondary' => ['Social Worker', 'Psychologist', 'HR Manager'],
                'description' => 'Your empathy and insight into human behavior suit helping professions and user-centered design.'
            ],
            'INFP' => [
                'primary' => 'Writer / Creative Director',
                'secondary' => ['Therapist', 'Teacher', 'Content Creator'],
                'description' => 'Your creativity and values-driven approach thrive in expressive and meaningful work.'
            ],
            'ENFJ' => [
                'primary' => 'HR Manager / Team Leader',
                'secondary' => ['Teacher', 'Coach', 'Public Relations Manager'],
                'description' => 'Your people skills and motivational abilities are perfect for leadership and development roles.'
            ],
            'ENFP' => [
                'primary' => 'Marketing Manager / Creative Consultant',
                'secondary' => ['Event Planner', 'Social Media Manager', 'Journalist'],
                'description' => 'Your enthusiasm and creativity excel in dynamic, people-oriented roles.'
            ],
            'ISTJ' => [
                'primary' => 'Accountant / Operations Manager',
                'secondary' => ['Financial Analyst', 'Quality Assurance', 'Administrator'],
                'description' => 'Your reliability and attention to detail are valued in structured, process-oriented roles.'
            ],
            'ISFJ' => [
                'primary' => 'Healthcare Professional / Administrator',
                'secondary' => ['Teacher', 'Social Worker', 'Office Manager'],
                'description' => 'Your caring nature and organizational skills suit service and support roles.'
            ],
            'ESTJ' => [
                'primary' => 'Business Manager / Supervisor',
                'secondary' => ['Project Manager', 'Sales Manager', 'Administrator'],
                'description' => 'Your decisiveness and organizational skills excel in management and coordination roles.'
            ],
            'ESFJ' => [
                'primary' => 'Customer Success Manager / HR Specialist',
                'secondary' => ['Event Coordinator', 'Nurse', 'Teacher'],
                'description' => 'Your interpersonal skills and desire to help others suit customer-facing and care roles.'
            ],
            'ISTP' => [
                'primary' => 'Engineer / Technical Specialist',
                'secondary' => ['Mechanic', 'Developer', 'Analyst'],
                'description' => 'Your practical problem-solving and technical skills suit hands-on, analytical work.'
            ],
            'ISFP' => [
                'primary' => 'Designer / Artist',
                'secondary' => ['Photographer', 'Chef', 'Counselor'],
                'description' => 'Your aesthetic sense and hands-on approach thrive in creative, expressive fields.'
            ],
            'ESTP' => [
                'primary' => 'Sales Manager / Entrepreneur',
                'secondary' => ['Marketing Manager', 'Consultant', 'Project Coordinator'],
                'description' => 'Your energy and adaptability excel in fast-paced, results-driven environments.'
            ],
            'ESFP' => [
                'primary' => 'Event Manager / Entertainer',
                'secondary' => ['Sales Representative', 'Tour Guide', 'Social Media Manager'],
                'description' => 'Your charisma and spontaneity suit dynamic, people-centered roles.'
            ],
        ];

        $careerData = $mbtiCareers[$mbtiType] ?? [
            'primary' => 'Career Counselor Recommended',
            'secondary' => ['Various opportunities based on your skills'],
            'description' => 'Your unique combination of traits opens many career paths.'
        ];

        // Build personalized recommendation
        $recommendation = "Based on your MBTI type ({$mbtiType}), we recommend: {$careerData['primary']}. ";
        $recommendation .= "{$careerData['description']} ";
        
        // Add skills-based context
        if (!empty($skills)) {
            $recommendation .= "Your skills in {$skills} will be particularly valuable. ";
        }
        
        // Add interests context
        if (!empty($interests)) {
            $recommendation .= "Your interest in {$interests} aligns well with this career path. ";
        }
        
        // Add academic context
        if (!empty($academic)) {
            $recommendation .= "Your {$academic} background provides a strong foundation. ";
        }
        
        // Add secondary options
        $recommendation .= "Other suitable roles include: " . implode(', ', $careerData['secondary']) . ".";

        return $recommendation;
    }

    public function getUserTestHistory()
    {
        $history = TestResult::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return response()->json($history);
    }
}