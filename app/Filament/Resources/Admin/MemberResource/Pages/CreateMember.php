<?php

namespace App\Filament\Resources\Admin\MemberResource\Pages;

use App\Filament\Resources\Admin\MemberResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMember extends CreateRecord
{
    protected static string $resource = MemberResource::class;
}
