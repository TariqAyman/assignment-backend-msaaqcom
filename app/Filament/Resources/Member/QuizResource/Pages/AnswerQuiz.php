<?php

namespace App\Filament\Resources\Member\QuizResource\Pages;

use App\Filament\Resources\Member\QuizResource;
use Filament\Actions;
use Filament\Resources\Pages\Page;

class AnswerQuiz extends Page
{
    protected static string $resource = QuizResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
