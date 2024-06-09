<?php

namespace App\Http\Controllers\API\V1\Member;

use App\Http\Controllers\API\AbstractApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Tenant\Quiz\QuizCreateRequest;
use App\Http\Requests\V1\Tenant\Quiz\QuizUpdatenRequest;
use App\Http\Resources\QuizResource;
use App\Models\Quiz;
use App\Repositories\QuizRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuizController extends AbstractApiController
{
    public function __construct(
        protected QuizRepository $quizRepository
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $quizzes = $this->quizRepository
            ->initiateQuery()
            ->whereNull('end_date')
            ->orWhere('end_date', '>', now())
            ->with(['questions.choices' => function ($query) {
                $query->orderBy('order', 'asc');
            }])
            ->paginate($request->get('per_page', 10));

        $quizzes = QuizResource::collection($quizzes);

        return $this->success($quizzes);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $quiz = $this->quizRepository->with(['questions.choices'])
            ->findOrFail($id);

        $quiz = QuizResource::make($quiz);

        return $this->success($quiz);
    }

    public function take(string $token, Request $request)
    {
        $quiz = $request->user()
            ->quizzes()
            ->with(['questions.choices' => function ($query) {
                $query->orderBy('order', 'asc');
            }])
            ->wherePivot('token', $token)
            ->whereNull('end_time')
            ->orWhere('end_time', '>', now())
            ->firstOrFail();

        $quiz = QuizResource::make($quiz);

        return $this->success($quiz);
    }
}
