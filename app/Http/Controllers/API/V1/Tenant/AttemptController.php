<?php

namespace App\Http\Controllers\API\V1\Tenant;

use App\Exports\AttemptExport;
use App\Http\Controllers\API\AbstractApiController;
use App\Http\Controllers\Controller;
use App\Listeners\SendCompletedExportNotification;
use App\Models\Attempt;
use App\Models\Member;
use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Http\Requests\V1\Tenant\ExportRequest;

class AttemptController extends AbstractApiController
{
    public function index()
    {
        $attempts = Attempt::with('member', 'quiz', 'answers')
            ->paginate(10);

        return $this->success($attempts);
    }

    public function show(Attempt $attempt)
    {
        $attempt->load('quiz', 'answers');

        return $this->success($attempt);
    }

    public function export(ExportRequest $request)
    {
        $data = $request->validated();

        (new AttemptExport($data))
            ->queue("attempts_{$request->user()->id}.csv")
            ->chain([
                new SendCompletedExportNotification($request->user(), "attempts_{$request->user()->id}.csv"),
            ]);

        return $this->success();
    }
}
