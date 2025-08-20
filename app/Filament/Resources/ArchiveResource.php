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

    public static function getNavigationSort(): int
    {
        return 4;
    }

   

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')->searchable(),
                  Tables\Columns\TextColumn::make('property.nombor_kait')
                    ->label('Nombor Kait')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client.name')
                    ->label('Nama Klien')
                    ->url(fn($record) => \App\Filament\Resources\ClientResource\Pages\ViewProperties::getUrl(['record' => $record->client_id]))
                    ->openUrlInNewTab()
                    ->color('primary')
                    ->formatStateUsing(fn($state) => "<span class='underline hover:text-blue-700'>$state</span>")
                    ->html()
                    ->sortable()
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('property.nombor_lot')
                    ->label('Nombor Lot')
                    ->searchable(),

                Tables\Columns\TextColumn::make('property.nombor_geran')
                    ->label('Nombor Geran')
                    ->searchable(),

                Tables\Columns\TextColumn::make('property.daerah')
                    ->label('Daerah')
                    ->searchable(),

                Tables\Columns\TextColumn::make('property.mukim')
                    ->label('Mukim')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')->label('Amaun')->money('MYR'),
               
                Tables\Columns\TextColumn::make('file_name')
                    ->label('Invois Dokumen')
                    ->url(fn($record) => $record->file_path
                        ? asset('storage/' . $record->file_path)
                        : null)
                    ->limit(30)
                    ->tooltip(fn($record) => $record->file_name),

             Tables\Columns\TextColumn::make('property.file_name')
    ->label('Surat Iringan')
    ->url(fn($record) => $record->property && $record->property->file_path
        ? asset('storage/' . $record->property->file_path)
        : null
    )
    ->openUrlInNewTab()
    ->limit(30)
    ->tooltip(fn($record) => $record->property?->file_name ?? 'No file'), Tables\Columns\TextColumn::make('issued_date')->label('Tarikh Dikeluarkan')->formatStateUsing(fn($state) => $state?->format('Y-m-d'))
    ->sortable(),
                Tables\Columns\TextColumn::make('due_date')->label('Tarikh Akhir')->formatStateUsing(fn($state) => $state?->format('Y-m-d'))
    ->sortable(),   Tables\Columns\TextColumn::make('status')->label('Status')->badge(),
             
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

    public static function getNavigationLabel(): string
    {
        return 'Arkib';  // Change 'Home' to your desired dashboard name
    }
}
