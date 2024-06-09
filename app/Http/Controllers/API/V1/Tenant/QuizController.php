<?php

namespace App\Http\Controllers\API\V1\Tenant;

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
        $quizzes = $this->quizRepository->paginate($request->get('per_page', 10));

        $quizzes = QuizResource::collection($quizzes);

        return $this->success($quizzes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuizCreateRequest $request)
    {
        $quiz = $this->quizRepository->create($request->all());

        $quiz = $this->quizRepository
            ->with(['questions.choices'])
            ->findOrFail($quiz->id);

        $quiz = QuizResource::make($quiz);

        return $this->success($quiz);
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $quiz = $this->quizRepository->with(['questions.choices'])
            ->findOrFail($id);

        $quiz = QuizResource::make($quiz);

        return $this->success($quiz);
    }

    /**
     * Update the specified resource in storage.
     * @throws \Exception
     */
    public function update(QuizUpdatenRequest $request, string $id)
    {
        $quiz = $this->quizRepository->update($id, $request->all());

        $quiz = $this->quizRepository->with(['questions.choices'])
            ->findOrFail($quiz->id);

        $quiz = QuizResource::make($quiz);

        return $this->success($quiz);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->quizRepository->delete($id);

        return $this->success(statusCode: Response::HTTP_NO_CONTENT);
    }
}
