<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArchiveResource\Pages;
use App\Models\Archive;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ArchiveResource extends Resource
{
    protected static ?string $model = Archive::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $recordTitleAttribute = 'invoice_number';
protected static ?string $recordKey = 'invoice_id';
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')->searchable(),
                Tables\Columns\TextColumn::make('client.name')
                ->label('Client')
                ->url(fn($record) => \App\Filament\Resources\ClientResource\Pages\ViewProperties::getUrl(['record' => $record->client_id]))
                ->openUrlInNewTab()
                ->color('primary')
                ->formatStateUsing(fn($state) => "<span class='underline hover:text-blue-700'>$state</span>")
                ->html()
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('amount')->money('MYR'),
                Tables\Columns\TextColumn::make('issued_date')->dateTime(),
                Tables\Columns\TextColumn::make('due_date')->dateTime(),
                Tables\Columns\TextColumn::make('status')->badge(),
            ])
            ->filters([
                // Add filters here if needed
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                // Disable delete since it's a view
                Tables\Actions\DeleteBulkAction::make()->visible(false),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArchives::route('/'),
            'view' => Pages\ViewArchive::route('/{record}'),
        ];
    }
}
