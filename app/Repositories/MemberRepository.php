<?php

namespace App\Repositories;

use App\Helpers\SlugHelper;
use App\Models\Choice;
use App\Models\Member;
use App\Models\Quiz;
use App\Repositories\AbstractRepository\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MemberRepository extends BaseRepository
{
    public function __construct(Member $model)
    {
        parent::__construct($model);
    }

    public function getMyQuizzes(Request $request): int
    {
        return $this->initiateQuery()
            ->whereHas('quizzes', function ($query) use ($request) {
                $query->where('member_id', $request->user()->id);
            })->count();
    }
}
