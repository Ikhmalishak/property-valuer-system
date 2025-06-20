<?php

namespace App\Filament\Resources\SenaraiRumahResource\Pages;

use App\Filament\Resources\SenaraiRumahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSenaraiRumah extends EditRecord
{
    protected static string $resource = SenaraiRumahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
