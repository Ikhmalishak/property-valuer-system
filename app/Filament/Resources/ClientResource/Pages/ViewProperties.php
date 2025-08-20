<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use App\Models\Client;
use App\Models\Property;
use Dom\Text;
use Filament\Resources\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;

class ViewProperties extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = ClientResource::class;

    protected static string $view = 'filament.resources.client-resource.pages.view-properties';

   public $record;

    public Client $client;

    public function mount($record): void
    {
        $this->record = $record;
        $this->client = Client::findOrFail($record);
    }

    protected function getTableQuery()
    {
        return Property::query()->where('client_id', $this->client->id);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('client.name')->label('Client')->searchable(),
            TextColumn::make('nombor_kait')->label('Nombor Kait'),
            TextColumn::make('invoice.invoice_number')->label('Nombor Invois'),
            TextColumn::make('nombor_lot')->label('Nombor Lot'),
            TextColumn::make('nombor_geran')->label('Nombor Geran'),
            TextColumn::make('daerah')->label('Daerah'),
            TextColumn::make('mukim')->label('Mukim'),
            TextColumn::make('invoice.amount')
                ->label('Amaun (MYR)')
                ->money('MYR')
                ->sortable(),

            TextColumn::make('invoice.file_name')
                ->label('Surat Invois')
                ->url(fn($record) => $record->invoice?->file_path ? asset('storage/' . $record->invoice->file_path) : null)
                ->openUrlInNewTab()
                ->limit(30)
                ->tooltip(fn($record) => $record->invoice?->file_name),

            TextColumn::make('file_name')
                ->label('Surat Iringan')
                ->url(fn($record) => $record->file_path ? asset('storage/' . $record->file_path) : null)
                ->openUrlInNewTab()
                ->limit(30)
                ->tooltip(fn($record) => $record->file_name),

            TextColumn::make('invoice.status')->label('Status')->badge(),
            TextColumn::make('created_at')
                ->label('Tarikh Dibuat')
                ->formatStateUsing(fn($state) => $state?->format('Y-m-d')),
        ];
    }

     public function getTitle(): string
    {
        return 'Properties of ' . $this->client->name;
    }
}
