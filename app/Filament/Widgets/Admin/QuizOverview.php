<?php

namespace App\Filament\Widgets\Admin;

use App\Enums\QuestionType;
use App\Models\Answer;
use App\Models\Choice;
use App\Models\Question;
use App\Models\Quiz;
use Filament\Widgets\StatsOverviewWidget;

class QuizOverview extends StatsOverviewWidget
{
    protected static ?int $sort = -3;

    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        return [
               StatsOverviewWidget\Stat::make(
                   label: 'Total Quizzes',
                   value: Quiz::query()->count(),
               ),
            StatsOverviewWidget\Stat::make(
                label: 'Total Questions',
                value: Question::query()->count(),
            ),
            StatsOverviewWidget\Stat::make(
                label: 'Total Choices',
                value: Choice::query()->count(),
            ),
            StatsOverviewWidget\Stat::make(
                label: 'Total Answers',
                value: Answer::query()->count(),
            ),
        ];
    }
}
