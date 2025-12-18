<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            [
                'question' => 'Q1: In a group project, are you the one who...',
                'options' => [
                    'E' => 'A. Takes charge and talks a lot',
                    'I' => 'B. Listens and thinks before speaking'
                ],
                'order' => 1
            ],
            [
                'question' => 'Q2: When solving problems, do you prefer...',
                'options' => [
                    'S' => 'A. Practical solutions',
                    'N' => 'B. Creative ideas'
                ],
                'order' => 2
            ],
            [
                'question' => 'Q3: When making decisions, do you rely more on...',
                'options' => [
                    'T' => 'A. Logic and facts',
                    'F' => 'B. Feelings and values'
                ],
                'order' => 3
            ],
            [
                'question' => 'Q4: Do you prefer your life to be...',
                'options' => [
                    'J' => 'A. Organized and planned',
                    'P' => 'B. Flexible and spontaneous'
                ],
                'order' => 4
            ]
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}