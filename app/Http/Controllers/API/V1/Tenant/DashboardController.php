<?php

namespace App\Http\Controllers\API\V1\Tenant;

use App\Enums\QuizType;
use App\Http\Controllers\API\AbstractApiController;
use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Repositories\AttemptRepository;
use App\Repositories\MemberRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\QuizRepository;
use Illuminate\Http\Request;

class DashboardController extends AbstractApiController
{
    public function __construct(
        protected QuestionRepository $questionRepository,
        protected QuizRepository     $quizRepository,
        protected MemberRepository   $memberRepository,
        protected AttemptRepository  $attemptRepository,
    )
    {
    }

    public function __invoke()
    {
        $response['quizzes'] = $this->quizRepository->count();
        $response['questions'] = $this->questionRepository->count();
        $response['members'] = $this->memberRepository->count();
        $response['member_chart'] = $this->memberRepository->countsPerMonth([]);
        $response['attempt_chart'] = $this->attemptRepository->countsPerMonth([]);
        $response['total_attempts'] = $this->attemptRepository->count();
        $response['total_pass_attempts'] = $this->attemptRepository->where('score', '>', 70)->count();
        $response['total_fail_attempts'] = $this->attemptRepository->where('score', '<', 70)->count();
        $response['avg_score_attempts'] = $this->attemptRepository
            ->initiateQuery()
            ->whereHas('quiz', fn($query) => $query->where('type', QuizType::IN_TIME))
            ->avg('score') ?? 0.0;

        return $this->success($response);
    }
}
