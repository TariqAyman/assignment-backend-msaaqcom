<?php

namespace App\Filament\Widgets\Admin;

use App\Models\Member;
use App\Models\Quiz;
use Filament\Widgets\StatsOverviewWidget;

class MemberOverview extends StatsOverviewWidget
{
    protected static ?int $sort = -1;

    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        return [
            StatsOverviewWidget\Stat::make(
                label: 'Total Members',
                value: Member::query()->count(),
            ),
        ];
    }
}
