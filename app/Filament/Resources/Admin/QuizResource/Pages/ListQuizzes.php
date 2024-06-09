<?php

namespace App\Filament\Resources\Admin\QuizResource\Pages;

use App\Enums\QuizType;
use App\Filament\Resources\Admin\QuizResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListQuizzes extends ListRecords
{
    protected static string $resource = QuizResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Quizzes'),
            'in-time' => Tab::make('In-time Quizzes')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', QuizType::IN_TIME)),
            'out-of-time' => Tab::make('Out-of-time Quizzes')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', QuizType::OUT_OF_TIME)),
        ];
    }
}
