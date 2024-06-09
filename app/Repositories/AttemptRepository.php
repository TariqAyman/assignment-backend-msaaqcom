<?php

namespace App\Repositories;

use App\Enums\QuestionType;
use App\Helpers\SlugHelper;
use App\Models\Attempt;
use App\Models\Question;
use App\Models\Quiz;
use App\Repositories\AbstractRepository\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AttemptRepository extends BaseRepository
{
    public function __construct(Attempt $model)
    {
        parent::__construct($model);
    }
}
