<?php

namespace App\Filament\Resources\ApplicationLogResource\Pages;

use App\Filament\Resources\ApplicationLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewApplicationLog extends ViewRecord
{
    protected static string $resource = ApplicationLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
