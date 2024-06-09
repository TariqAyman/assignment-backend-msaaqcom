<?php

namespace App\Filament\Widgets\Admin;

use App\Enums\QuizType;
use App\Models\Attempt;
use App\Models\Member;
use Filament\Widgets\StatsOverviewWidget;

class AttemptOverview extends StatsOverviewWidget
{
    protected static ?int $sort = -2;

    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        return [
            StatsOverviewWidget\Stat::make(
                label: 'Total Attempts',
                value: Attempt::query()->count(),
            ),
            StatsOverviewWidget\Stat::make(
                label: 'Total Pass Attempts',
                value: Attempt::query()->where('score', '>', 70)->count(),
            ),
            StatsOverviewWidget\Stat::make(
                label: 'Total Fail Attempts',
                value: Attempt::query()->where('score', '<', 70)->count(),
            ),
            StatsOverviewWidget\Stat::make(
                label: 'Avg score Attempts',
                value: Attempt::query()
                ->whereHas('quiz', fn($query) => $query->where('type', QuizType::IN_TIME))
                ->avg('score') ?? 0.0,
            ),
        ];
    }
}
