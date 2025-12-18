<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\JobListing;
use App\Models\TestQuestion;
use App\Models\Question; // Added this to prevent errors

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Test User (Pass plain password)
        User::create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => '123123123', // <--- Plain text
            'phone' => '+60 12-345 6789',
            'age' => '25',
            'nationality' => '🇲🇾 Malaysia',
            'avatar' => '😊',
            'is_admin' => false,
            'status' => 'active'
        ]);

        // 2. Create Admin User (Pass plain password)
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => 'admin123', // <--- Plain text
            'is_admin' => true,
            'status' => 'active'
        ]);

        // 3. Create Sample Jobs
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

        // 4. Create Test Questions (Using correct format)
        $this->call(QuestionSeeder::class);
    }
}