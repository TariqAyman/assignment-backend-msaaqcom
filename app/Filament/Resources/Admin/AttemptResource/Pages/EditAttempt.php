<?php

namespace App\Filament\Resources\Admin\AttemptResource\Pages;

use App\Filament\Resources\Admin\AttemptResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttempt extends EditRecord
{
    protected static string $resource = AttemptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
