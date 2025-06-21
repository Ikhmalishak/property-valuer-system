<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use App\Models\Client;
use App\Models\Property;
use Filament\Resources\Pages\Page;
use Filament\Tables;
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
            Tables\Columns\TextColumn::make('type'),
            Tables\Columns\TextColumn::make('address'),
            Tables\Columns\TextColumn::make('description'),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),
        ];
    }

    public function getTitle(): string
    {
        return 'Properties of ' . $this->client->name;
    }
}
