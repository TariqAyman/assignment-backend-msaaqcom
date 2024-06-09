<?php

namespace App\Filament\Resources\Admin\AttemptResource\Pages;

use App\Filament\Resources\Admin\AttemptResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttempts extends ListRecords
{
    protected static string $resource = AttemptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
