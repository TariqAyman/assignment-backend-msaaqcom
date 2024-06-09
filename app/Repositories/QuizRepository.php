<?php

namespace App\Repositories;

use App\Enums\QuestionType;
use App\Helpers\SlugHelper;
use App\Models\Question;
use App\Models\Quiz;
use App\Repositories\AbstractRepository\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class QuizRepository extends BaseRepository
{
    public function __construct(
        Quiz                         $model,
        protected QuestionRepository $questionRepository,
        protected ChoiceRepository   $choiceRepository
    )
    {
        parent::__construct($model);
    }

    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {
            $attributes['slug'] = SlugHelper::generateUniqueSlug(Quiz::class, $attributes['title']);

            $quiz = parent::create($attributes);

            if (!empty($attributes['questions'])) {
                $questionsFromRequest = $attributes['questions'];
                foreach ($questionsFromRequest as $question) {
                    match ($question['type']) {
                        QuestionType::TEXT => $this->saveTextQuestion($quiz, $question),
                        QuestionType::TRUE_FALSE => $this->saveTrueFalseQuestion($quiz, $question),
                        QuestionType::CHOICES => $this->saveChoicesQuestion($quiz, $question),
                        default => throw new \Exception('Unknown question type'),
                    };
                }
            }

            return $quiz;
        });
    }

    public function saveTextQuestion($quiz, mixed $question): void
    {
        $this->questionRepository
            ->create([
                'quiz_id' => $quiz->id,
                'question' => $question['question'],
                'type' => QuestionType::TEXT,
                'description' => $question['description'],
            ]);
    }

    public function saveTrueFalseQuestion($quiz, mixed $questionFromRequest): void
    {
        $question = $this->questionRepository
            ->create([
                'quiz_id' => $quiz->id,
                'question' => $questionFromRequest['question'],
                'type' => QuestionType::TRUE_FALSE,
                'description' => $questionFromRequest['description'],
            ]);

        $isTrue = ((bool)$questionFromRequest['is_correct']);

        $question
            ->choices()
            ->create([
                'question_id' => $question->id,
                'title' => $isTrue ? 'True' : 'False',
                'is_correct' => ((bool)$questionFromRequest['is_correct']),
            ]);
    }

    public function saveChoicesQuestion($quiz, mixed $questionFromRequest): void
    {
        $question = $this->questionRepository
            ->create([
                'quiz_id' => $quiz->id,
                'question' => $questionFromRequest['question'],
                'type' => QuestionType::CHOICES,
                'description' => $questionFromRequest['description'],
            ]);

        foreach ($questionFromRequest['choices'] as $choice) {
            $choice  = $choice['data'];

            $this->choiceRepository
                ->create([
                    'question_id' => $question->id,
                    'title' => $choice['title'],
                    "description" => $choice['description'],
                    "explanation" => $choice['explanation'],
                    "order" => $choice['order'],
                    'is_correct' => ((bool)$choice['is_correct']),
                ]);
        }
    }
}
