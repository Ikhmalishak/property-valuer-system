<?php

namespace App\Filament\Resources\ApplicationLogResource\Pages;

use App\Filament\Resources\ApplicationLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApplicationLog extends EditRecord
{
    protected static string $resource = ApplicationLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
