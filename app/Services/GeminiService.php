<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected $apiKey;
    protected $baseUrl = 'https://generativelanguage.googleapis.com/v1/models';

    public function __construct()
    {
        $this->apiKey = config('gemini.api_key');
    }

    /**
     * Chatbot conversation - Quick and cheerful responses
     */
    public function chat($message)
    {
        $systemPrompt = "You are a cheerful, encouraging career assistant named 'Career Buddy'. 
Your personality: friendly, supportive, always positive, uses emojis.
Keep responses SHORT (2-3 sentences max).
Help users navigate the career website.
Always be encouraging!

User message: {$message}

Respond in a cheerful, helpful way:";

        try {
            return $this->generateResponse($systemPrompt);
        } catch (\Exception $e) {
            Log::error('Gemini Chat Error: ' . $e->getMessage());
            return "Oops! I'm having a moment! 💫 But don't worry - you're doing great! Try asking me again in a moment!";
        }
    }

    /**
     * Generate career recommendations from test results
     * ALWAYS returns at least 2-3 jobs!
     */
    public function analyzeCareerTest($mbtiType, $skills, $background)
    {
        $prompt = "You are an expert career counselor analyzing a personality test.

MBTI Type: {$mbtiType}
Skills: {$skills}
Academic Background: {$background}

TASK: Provide career guidance in this EXACT format:

1. Write ONE encouraging sentence about their personality type
2. List EXACTLY 3 job recommendations with:
   - Job title
   - Why it's a good fit (1 sentence)
   - Typical salary range in Malaysia (use MYR)
3. End with ONE positive affirmation

IMPORTANT RULES:
- Be encouraging and positive
- MUST recommend exactly 3 different jobs
- Use realistic Malaysian salary ranges
- Keep it concise but motivating

Example format:
'Your [TYPE] personality shows great potential for creative problem-solving!

Recommended Careers:
1. Software Developer - Your analytical thinking is perfect for coding. Salary: MYR 4,000-8,000/month
2. Data Analyst - You'll excel at finding patterns in data. Salary: MYR 3,500-7,000/month  
3. UX Designer - Your empathy helps create user-friendly designs. Salary: MYR 3,000-6,500/month

You have a bright future ahead! Keep developing your skills! 🌟'";

        try {
            $response = $this->generateResponse($prompt);
            
            // Fallback if AI fails - ALWAYS provide jobs!
            if (empty($response) || strlen($response) < 50) {
                return $this->getFallbackCareerRecommendations($mbtiType);
            }
            
            return $response;
            
        } catch (\Exception $e) {
            Log::error('Gemini Career Test Error: ' . $e->getMessage());
            return $this->getFallbackCareerRecommendations($mbtiType);
        }
    }

    /**
     * Profile encouragement based on completion
     */
    public function getProfileEncouragement($completionPercentage, $hasResume, $applicationCount)
    {
        $prompt = "Generate ONE encouraging message for a job seeker based on their progress.

Profile Completion: {$completionPercentage}%
Has Resume: " . ($hasResume ? 'Yes' : 'No') . "
Applications Submitted: {$applicationCount}

Rules:
- ONE sentence only (max 15 words)
- Be specific to their progress level
- Always positive and motivating
- Use 1 emoji
- No generic phrases

Examples:
- 0-30%: 'Every expert started as a beginner - let's build your future together! 🌟'
- 31-60%: 'Great progress! Keep going - employers love dedicated candidates like you! 💪'
- 61-90%: 'Almost there! Your profile is looking fantastic! 🎉'
- 91-100%: 'Outstanding! You're absolutely ready to shine! ✨'";

        try {
            return $this->generateResponse($prompt);
        } catch (\Exception $e) {
            Log::error('Gemini Profile Error: ' . $e->getMessage());
            return $this->getFallbackEncouragement($completionPercentage);
        }
    }

    /**
     * Main API call to Gemini
     */
    protected function generateResponse($prompt)
{
   $url = "{$this->baseUrl}/gemini-2.5-flash:generateContent?key={$this->apiKey}";

        $response = Http::timeout(10)->post($url, [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.9,
                'topK' => 40,
                'topP' => 0.95,
                'maxOutputTokens' => 800,
            ],
            'safetySettings' => [
                [
                    'category' => 'HARM_CATEGORY_HARASSMENT',
                    'threshold' => 'BLOCK_ONLY_HIGH'
                ],
                [
                    'category' => 'HARM_CATEGORY_HATE_SPEECH',
                    'threshold' => 'BLOCK_ONLY_HIGH'
                ]
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();
            
            if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                return trim($data['candidates'][0]['content']['parts'][0]['text']);
            }
        }

        throw new \Exception('API request failed: ' . $response->body());
    }

    /**
     * Fallback career recommendations (if AI fails)
     */
    protected function getFallbackCareerRecommendations($mbtiType)
    {
        $recommendations = [
            'INTJ' => "Your INTJ personality shows exceptional strategic thinking! 🎯

Recommended Careers:
1. Software Architect - Perfect for your systematic approach. Salary: MYR 6,000-12,000/month
2. Data Scientist - Your analytical mind excels here. Salary: MYR 5,000-10,000/month
3. Management Consultant - Strategic planning is your strength. Salary: MYR 4,500-9,000/month

Your logical thinking will lead you to great success! Keep building your expertise! 🌟",

            'ENTJ' => "Your ENTJ leadership qualities are impressive! 💼

Recommended Careers:
1. Project Manager - Lead teams to success naturally. Salary: MYR 5,000-10,000/month
2. Business Analyst - Strategic decisions are your forte. Salary: MYR 4,500-8,500/month
3. Marketing Director - Your vision drives results. Salary: MYR 6,000-12,000/month

You're born to lead! Your future is incredibly bright! ✨",

            'INFP' => "Your INFP creativity and empathy are wonderful! 💜

Recommended Careers:
1. UX/UI Designer - Create beautiful, user-friendly experiences. Salary: MYR 3,500-7,000/month
2. Content Writer - Your writing touches hearts. Salary: MYR 3,000-6,000/month
3. Counselor - Help others with your empathy. Salary: MYR 3,200-6,500/month

Your creativity will make the world better! Keep following your passion! 🌈"
        ];

        // Return specific or default recommendation
        return $recommendations[$mbtiType] ?? "You have amazing potential! 🌟

Recommended Careers:
1. Software Developer - Great problem-solving opportunity. Salary: MYR 4,000-8,000/month
2. Marketing Specialist - Creative and analytical. Salary: MYR 3,500-7,000/month
3. HR Executive - People-focused role. Salary: MYR 3,000-6,000/month

Your unique skills will take you far! Believe in yourself! 💪";
    }

    /**
     * Fallback encouragement (if AI fails)
     */
    protected function getFallbackEncouragement($completionPercentage)
    {
        if ($completionPercentage < 30) {
            return "Every journey starts with a single step - let's build your future! 🌟";
        } elseif ($completionPercentage < 60) {
            return "You're making great progress! Keep going strong! 💪";
        } elseif ($completionPercentage < 90) {
            return "Almost there! Your profile looks fantastic! 🎉";
        } else {
            return "Outstanding! You're ready to shine! ✨";
        }
    }
}