<?php

namespace App\Filament\Resources\SenaraiRumahResource\Pages;

use App\Filament\Resources\SenaraiRumahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSenaraiRumahs extends ListRecords
{
    protected static string $resource = SenaraiRumahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
