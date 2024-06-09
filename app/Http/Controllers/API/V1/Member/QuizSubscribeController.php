<?php

namespace App\Http\Controllers\API\V1\Member;

use App\Events\SubscribedProcessed;
use App\Http\Controllers\API\AbstractApiController;
use App\Http\Controllers\Controller;
use App\Repositories\QuizRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuizSubscribeController extends AbstractApiController
{

    public function __construct(
        protected QuizRepository $quizRepository
    )
    {
    }

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'quiz_id' => 'required|exists:quizzes,id',
        ]);

        $quiz = $this->quizRepository->findOrFail($request->get('quiz_id'));

        if (!$quiz->members()->where('member_id', $request->user()->id)->exists()) {

            if ($quiz->end_date && $quiz->end_date < now()) {
                return $this->badRequest(['message' => 'Quiz has ended.']);
            }

            if ($quiz->start_date && $quiz->start_date > now()) {
                return $this->badRequest(['message' => 'Quiz has not started.']);
            }

            $quiz->members()->attach($request->user()->id, ['token' => $token = strtolower(Str::ulid())]);

            SubscribedProcessed::dispatch($request->user(), $quiz, $token);
        } else {
            return $this->badRequest(['message' => 'Already subscribed.']);
        }

        return $this->success(['message' => 'Successfully subscribed to quiz.']);
    }
}
