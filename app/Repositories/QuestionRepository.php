<?php

namespace App\Repositories;

use App\Helpers\SlugHelper;
use App\Models\Question;
use App\Models\Quiz;
use App\Repositories\AbstractRepository\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class QuestionRepository extends BaseRepository
{
    public function __construct(Question $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes)
    {
        $attributes['slug'] = SlugHelper::generateUniqueSlug(Question::class, $attributes['question']);

        return parent::create($attributes);
    }

}
