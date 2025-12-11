<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TestQuestion;

class TestQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'question' => 'Q1: In a group project, are you the one who...',
                'options' => [
                    ['text' => 'A. Takes charge and talks a lot', 'value' => 'E'],
                    ['text' => 'B. Listens and thinks before speaking', 'value' => 'I'],
                ],
                'order' => 1,
            ],
            [
                'question' => 'Q2: When solving problems, do you prefer...',
                'options' => [
                    ['text' => 'A. Practical solutions', 'value' => 'S'],
                    ['text' => 'B. Creative ideas', 'value' => 'N'],
                ],
                'order' => 2,
            ],
            [
                'question' => 'Q3: When making decisions, do you rely more on...',
                'options' => [
                    ['text' => 'A. Logic and facts', 'value' => 'T'],
                    ['text' => 'B. Feelings and values', 'value' => 'F'],
                ],
                'order' => 3,
            ],
            [
                'question' => 'Q4: Do you prefer your life to be...',
                'options' => [
                    ['text' => 'A. Organized and planned', 'value' => 'J'],
                    ['text' => 'B. Flexible and spontaneous', 'value' => 'P'],
                ],
                'order' => 4,
            ],
        ];

        foreach ($questions as $question) {
            TestQuestion::create($question);
        }
    }
}