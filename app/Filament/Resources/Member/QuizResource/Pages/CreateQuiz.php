<?php

namespace App\Filament\Resources\Member\QuizResource\Pages;

use App\Filament\Resources\Member\QuizResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateQuiz extends CreateRecord
{
    protected static string $resource = QuizResource::class;
}
