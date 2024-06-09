<?php

namespace App\Http\Controllers\API\V1\Member;

use App\Events\FinishedProcessed;
use App\Http\Controllers\API\AbstractApiController;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Repositories\QuizRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AnswerQuestionController extends AbstractApiController
{

    public function __construct(
        protected QuizRepository $quizRepository
    )
    {
    }

    public function __invoke($id, Request $request)
    {
        return DB::transaction(function () use ($id, $request) {

            $quiz = $this->quizRepository->findOrFail($id);

            if ($quiz->end_date && $quiz->end_date < now()) {
                return $this->badRequest(['message' => 'Quiz has ended.']);
            }

            if ($quiz->start_date && $quiz->start_date > now()) {
                return $this->badRequest(['message' => 'Quiz has not started.']);
            }

            $this->validate($request, [
                'questions' => ['required', 'array', "min:{$quiz->questions->count()}", "max:{$quiz->questions->count()}"],
                'questions.*.id' => ['required', 'exists:questions,id'],
                'questions.*.answer' => ['required'],
                'questions.*.attempt' => ['image', 'file'],
            ]);

            $questions = $request->get('questions');

            $correctAnswersCount = 0;

            $attempt = $quiz->attempts()
                ->create([
                    'member_id' => $request->user()->id,
                    'score' => ($correctAnswersCount / $quiz->questions->count()) * 100,
                ]);

            $quiz->questions()
                ->each(function ($question) use ($attempt, &$correctAnswersCount, $request, $questions) {
                    $questionFromRequest = collect($questions)->firstWhere('id', $question->id);

                    $question->answers()
                        ->create([
                            'question' => $question->question,
                            'member_id' => $request->user()->id,
                            'attempt_id' => $attempt->id,
                            'chosen_answers' => [$questionFromRequest['answer']],
                            'is_correct' => $isCorrect = $question->isCorrectAnswer($questionFromRequest['answer']),
                            'correct_answers' => $question->choices()->where('is_correct', 1)->select(['id', 'title', 'is_correct'])->get(),
                        ]);

                    if ($isCorrect) {
                        $correctAnswersCount++;
                    }
                });

            $attempt->update(['score' => ($correctAnswersCount / $quiz->questions->count()) * 100]);

            FinishedProcessed::dispatch($request->user(), $attempt);

            return $this->success(['message' => 'Successfully Answer quiz.']);
        });
    }
}
