<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArchiveResource\Pages;
use App\Models\Archive;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class ArchiveResource extends Resource
{
    protected static ?string $model = Archive::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $recordTitleAttribute = 'invoice_number';

    public static function getNavigationSort(): int
    {
        return 4; // Shows after other resources
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 TextColumn::make('client.name')
                    ->label('Nama Klien')
                    ->url(fn($record) => \App\Filament\Resources\ClientResource\Pages\ViewProperties::getUrl(['record' => $record->client_id]))
                    ->openUrlInNewTab()
                    ->color('info')
                    ->formatStateUsing(fn($state) => "<span class='underline hover:text-blue-700'>$state</span>")
                    ->html()
                    ->sortable()
                    ->searchable(),

 TextColumn::make('invoice_number')
                    ->label('Nombor Invois')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('property.nombor_kait')
                    ->label('Nombor Kait')
                    ->searchable()
                    ->sortable(),

              
                TextColumn::make('property.nombor_lot')
                    ->label('Nombor Lot')
                    ->searchable(),

                TextColumn::make('property.nombor_geran')
                    ->label('Nombor Geran')
                    ->searchable(),

                TextColumn::make('property.daerah')
                    ->label('Daerah')
                    ->searchable(),

                TextColumn::make('property.mukim')
                    ->label('Mukim')
                    ->searchable(),

                TextColumn::make('amount')
                    ->label('Amaun (MYR)')
                    ->money('MYR')
                    ->sortable(),

                TextColumn::make('file_name')
                    ->label('Invois Dokumen')
                    ->url(fn($record) => $record->file_path ? asset('storage/' . $record->file_path) : null)
                    ->openUrlInNewTab()
                    ->limit(30)
                    ->tooltip(fn($record) => $record->file_name ?? 'No file')
                    ->sortable(),

                TextColumn::make('property.file_name')
                    ->label('Surat Iringan')
                    ->url(fn($record) => $record->property && $record->property->file_path
                        ? asset('storage/' . $record->property->file_path)
                        : null
                    )
                    ->openUrlInNewTab()
                    ->limit(30)
                    ->tooltip(fn($record) => $record->property?->file_name ?? 'No file')
                    ->sortable(),

                TextColumn::make('issued_date')
                    ->label('Tarikh Dikeluarkan')
                    ->date('Y-m-d')
                    ->sortable(),

                TextColumn::make('due_date')
                    ->label('Tarikh Akhir')
                    ->date('Y-m-d')
                    ->sortable(),
            ])
            ->filters([
                // Optional: Add filters later
                Tables\Filters\SelectFilter::make('client.branch')
                    ->relationship('client', 'branch')
                    ->label('Cawangan')
                    ->searchable()
                    ->preload(),

                Tables\Filters\Filter::make('issued_date')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('from'),
                        \Filament\Forms\Components\DatePicker::make('to'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], fn($q, $date) => $q->whereDate('issued_date', '>=', $date))
                            ->when($data['to'], fn($q, $date) => $q->whereDate('issued_date', '<=', $date));
                    })
                    ->label('Tarikh Dikeluarkan'),
            ])
            ->actions([
            Tables\Actions\EditAction::make()
                ->label('Edit'),
            Tables\Actions\DeleteAction::make()
                ->label('Padam'),
      ])
            ->bulkActions([
                // Disabled for safety in archive
            ]);
    }

    /**
     * Show newest archives first
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('status', 'paid') // Only show paid invoices as archived
            ->orderBy('issued_date', 'desc') // Sort by date issued, newest first
            ->orderBy('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArchives::route('/'),
            // 'view' => Pages\ViewArchive::route('/{record}'), // Uncomment if you implement view page
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Arkib';
    }

    public static function getPluralLabel(): string
    {
        return 'Arkib';
    }
}