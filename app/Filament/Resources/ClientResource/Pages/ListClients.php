<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClients extends ListRecords
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Klien'),
        ];

    }
    public function getTitle(): string
    {
        return 'Senarai Klien'; // page title
    }

    public static function getLabel(): string
    {
        return 'Klien'; // new singular name
    }

    public static function getPluralLabel(): string
    {
        return 'Klien'; // new plural name
    }

}
