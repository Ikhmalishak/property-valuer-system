<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use App\Filament\Widgets\InvoiceHelpNote; // ✅ Import the widget
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInvoices extends ListRecords
{
    protected static string $resource = InvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Invois'),
        ];
    }

    /**
     * Add help note at the bottom
     */
    protected function getFooterWidgets(): array
    {
        return [
            InvoiceHelpNote::class, // ✅ Now works!
        ];
    }
}