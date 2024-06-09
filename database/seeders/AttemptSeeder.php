<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttemptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve all tenants
        $tenants = Tenant::all();

        // Loop through each tenant to seed attempts
        $tenants->each(function ($tenant) {

            // Retrieve members and quizzes for the current tenant
            $members = Member::all();
            $quizzes = Quiz::with('questions.choices')->get();

            // Seed 2000 attempts
            for ($i = 0; $i < 2000; $i++) {
                if ($quizzes->count() > 0 && $members->count() > 0) {
                    $this->createAttempt($members, $quizzes);
                    $this->createAttempt($members, $quizzes);
                }
            }
        });
    }

    /**
     * Create a single attempt for a random member and quiz.
     *
     * @param \Illuminate\Support\Collection $members
     * @param \Illuminate\Support\Collection $quizzes
     * @return void
     */
    private function createAttempt($members, $quizzes): void
    {
        // Select random member and quiz
        $member = $members->random();
        $quiz = $quizzes->random();

        // Initialize answers and correct answers count
        $answers = [];
        $correctAnswersCount = 0;

        // Loop through each question in the selected quiz
        foreach ($quiz->questions as $question) {
            $this->processQuestion($member, $question, $answers, $correctAnswersCount);
        }

        // Calculate score and create the attempt
        if ($quiz->questions->count()) {
            $score = ($correctAnswersCount / $quiz->questions->count()) * 100;
        } else {
            $score = 0;
        }

        $attempt = $quiz->attempts()->create([
            'tenant_id' => $member->tenant_id,
            'member_id' => $member->id,
            'score' => $score,
        ]);

        // Associate answers with the attempt
        $attempt->answers()->createMany($answers);
    }

    /**
     * Process a single question to generate answers and count correct answers.
     *
     * @param $member
     * @param Question $question
     * @param array $answers
     * @param int $correctAnswersCount
     * @return void
     */
    private function processQuestion($member, $question, &$answers, &$correctAnswersCount): void
    {
        // Retrieve correct choices and randomly chosen answers
        $correctChoices = $question->choices->where('is_correct', true);
        $chosenAnswers = $question->choices->random($question->choices->count());

        // Determine if the chosen answers are correct
        $correctChoicesArray = $correctChoices->pluck('id')->toArray();
        $chosenAnswersArray = $chosenAnswers->pluck('id')->toArray();
        $isCorrect = empty(array_diff($correctChoicesArray, $chosenAnswersArray)) && empty(array_diff($chosenAnswersArray, $correctChoicesArray));

        // Store the answer details
        $answers[] = [
            'tenant_id' => $member->tenant_id,
            'member_id' => $member->id,
            'question_id' => $question->id,
            'question' => $question->question,
            'is_correct' => $isCorrect,
            'chosen_answers' => $chosenAnswers->pluck('title')->toArray(),
            'correct_answers' => $correctChoices->pluck('title')->toArray(),
        ];

        // Increment correct answers count if the answer is correct
        if ($isCorrect) {
            $correctAnswersCount++;
        }
    }
}
