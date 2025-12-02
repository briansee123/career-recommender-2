<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\JobListing;
use App\Models\TestQuestion;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create test user
        User::create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => Hash::make('123123123'),
            'phone' => '+60 12-345 6789',
            'age' => '25',
            'nationality' => '🇲🇾 Malaysia',
            'avatar' => '😊',
            'is_admin' => false,
            'status' => 'active'
        ]);

        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
            'status' => 'active'
        ]);

        // Create sample jobs
        JobListing::create([
            'title' => 'Software Engineer',
            'company' => 'Google Inc.',
            'company_icon' => 'G',
            'location' => 'Mountain View, CA',
            'salary' => 'USD 120,000 - 180,000',
            'description' => 'Join our team as a Software Engineer...',
            'job_type' => 'full-time',
            'status' => 'active',
            'is_available' => true,
            'posted_date' => now(),
            'required_skills' => ['Python', 'C++', 'AWS']
        ]);

        JobListing::create([
            'title' => 'Data Scientist',
            'company' => 'Amazon',
            'company_icon' => 'A',
            'location' => 'Seattle, WA',
            'salary' => 'USD 110,000 - 160,000',
            'description' => 'Analyze data and build ML models...',
            'job_type' => 'full-time',
            'status' => 'active',
            'is_available' => true,
            'posted_date' => now(),
            'required_skills' => ['R', 'Python', 'Machine Learning']
        ]);

        // Create test questions
        TestQuestion::create([
            'question' => 'Q1: In a group project, are you the one who...',
            'options' => [
                ['value' => 'E', 'text' => 'A. Takes charge and talks a lot'],
                ['value' => 'I', 'text' => 'B. Listens and thinks before speaking']
            ],
            'mbti_type' => 'E',
            'order' => 1,
            'is_active' => true
        ]);

        TestQuestion::create([
            'question' => 'Q2: When solving problems, do you prefer...',
            'options' => [
                ['value' => 'S', 'text' => 'A. Practical solutions'],
                ['value' => 'N', 'text' => 'B. Creative ideas']
            ],
            'mbti_type' => 'S',
            'order' => 2,
            'is_active' => true
        ]);

        TestQuestion::create([
            'question' => 'Q3: When making decisions, do you rely more on...',
            'options' => [
                ['value' => 'T', 'text' => 'A. Logic and facts'],
                ['value' => 'F', 'text' => 'B. Feelings and values']
            ],
            'mbti_type' => 'T',
            'order' => 3,
            'is_active' => true
        ]);

        TestQuestion::create([
            'question' => 'Q4: Do you prefer your life to be...',
            'options' => [
                ['value' => 'J', 'text' => 'A. Organized and planned'],
                ['value' => 'P', 'text' => 'B. Flexible and spontaneous']
            ],
            'mbti_type' => 'J',
            'order' => 4,
            'is_active' => true
        ]);
    }
}