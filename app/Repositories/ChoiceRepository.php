<?php

namespace App\Repositories;

use App\Helpers\SlugHelper;
use App\Models\Choice;
use App\Models\Quiz;
use App\Repositories\AbstractRepository\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class ChoiceRepository extends BaseRepository
{
    public function __construct(Choice $model)
    {
        parent::__construct($model);
    }
}
