<?php

namespace App\Http\Controllers\API\V1\Member;

use App\Http\Controllers\API\AbstractApiController;
use App\Http\Controllers\Controller;
use App\Repositories\MemberRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\QuizRepository;
use Illuminate\Http\Request;

class DashboardController extends AbstractApiController
{
    public function __construct(
        protected QuestionRepository $questionRepository,
        protected QuizRepository     $quizRepository,
        protected MemberRepository   $memberRepository
    )
    {
    }

    public function __invoke(Request $request)
    {
        $response['quizzes'] = $this->quizRepository->count();
        $response['questions'] = $this->questionRepository->count();
        $response['quizzes_subscribed'] = $this->memberRepository->getMyQuizzes($request);

        return $this->success($response);
    }
}
