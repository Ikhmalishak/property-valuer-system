<?php

namespace App\Filament\Resources\PropertyResource\Pages;

use App\Filament\Resources\PropertyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProperties extends ListRecords
{
    protected static string $resource = PropertyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Hartanah'),
        ];
    }

    public static function getPluralLabel(): string
    {
        return 'Klien'; // new singular name
    }

    public function getBreadcrumb(): string
    {
        return 'Senarai Hartanah';
    }
}
