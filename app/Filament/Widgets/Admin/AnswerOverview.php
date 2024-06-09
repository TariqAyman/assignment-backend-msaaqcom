<?php

namespace App\Filament\Widgets\Admin;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class AnswerOverview extends BaseWidget
{
    protected static ?int $sort = 0;

    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        return [
            //
        ];
    }
}
