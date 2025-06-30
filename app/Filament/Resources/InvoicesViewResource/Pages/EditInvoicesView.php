<?php

namespace App\Filament\Resources\InvoicesViewResource\Pages;

use App\Filament\Resources\InvoicesViewResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInvoicesView extends EditRecord
{
    protected static string $resource = InvoicesViewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
