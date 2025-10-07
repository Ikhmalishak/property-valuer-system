<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use App\Filament\Resources\InvoiceResource\Pages\ListInvoices;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('client_id')
                ->label('Klien')
                ->relationship('client', 'name')
                ->required(),

            TextInput::make('nombor_kait')
                ->label('Nombor Kait')
                ->required(),

            TextInput::make('nombor_lot')
                ->label('Nombor Lot')
                ->required(),

            TextInput::make('nombor_geran')
                ->label('Nombor Geran')
                ->required(),

            TextInput::make('daerah')
                ->label('Daerah')
                ->required(),

            TextInput::make('mukim')
                ->label('Mukim')
                ->required(),

            FileUpload::make('file_path')
                ->label('Surat Iringan')
                ->directory('properties')
                ->disk('public')
                ->preserveFilenames()
                ->nullable()
                ->storeFileNamesIn('file_name'),

            TextInput::make('file_name')
                ->label('Nama Fail')
                ->readonly()
                ->dehydrated(true)
                ->hidden(),
        ]);
    }

    public static function getNavigationSort(): int
    {
        return 1;
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('client.name')
                ->label('Klien')
                ->url(fn($record) => ListInvoices::getUrl(['filters' => ['client_id' => $record->client_id]]))
                ->openUrlInNewTab()
                ->color('info')
                ->formatStateUsing(fn($state) => "<span class='underline hover:text-blue-700'>$state</span>")
                ->html()
                ->sortable()
                ->searchable(),

            TextColumn::make('nombor_kait')
                ->label('Nombor Kait')
                ->searchable(),

            TextColumn::make('nombor_lot')
                ->label('Nombor Lot')
                ->searchable(),

            TextColumn::make('nombor_geran')
                ->label('Nombor Geran')
                ->searchable(),

            TextColumn::make('daerah')
                ->label('Daerah'),

            TextColumn::make('mukim')
                ->label('Mukim'),

            TextColumn::make('file_name')
                ->label('Surat Iringan')
                ->url(fn($record) => $record->file_path ? asset('storage/' . $record->file_path) : null)
                ->openUrlInNewTab()
                ->limit(30)
                ->tooltip(fn($record) => $record->file_name),

            // Hidden for now - only relevant if user has invoice access
            TextColumn::make('invoice.file_name')
                ->label('Invois')
                ->url(fn($record) => $record->invoices->first()?->file_path ? asset('storage/' . $record->invoices->first()->file_path) : null)
                ->openUrlInNewTab()
                ->limit(30)
                ->tooltip(fn($record) => $record->invoices->first()?->file_name)
                ->visible(false), // ðŸ‘ˆ Safely hidden (no role check needed)
        ])
        ->filters([
            SelectFilter::make('client_id')
                ->relationship('client', 'name')
                ->label('Filter by Client')
                ->searchable()
                ->preload(),

            SelectFilter::make('daerah')
                ->options(function () {
                    return Property::query()->distinct()->pluck('daerah', 'daerah');
                })
                ->label('Daerah'),

            SelectFilter::make('mukim')
                ->options(function () {
                    return Property::query()->distinct()->pluck('mukim', 'mukim');
                })
                ->label('Mukim'),

            Filter::make('created_at')
                ->form([
                    Forms\Components\DatePicker::make('created_from'),
                    Forms\Components\DatePicker::make('created_until'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when($data['created_from'], fn($q, $date) => $q->whereDate('created_at', '>=', $date))
                        ->when($data['created_until'], fn($q, $date) => $q->whereDate('created_at', '<=', $date));
                }),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make()
                ->label('Padam'),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    /**
     * Ensure the newest property appears at the top.
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->orderBy('created_at', 'desc'); // âœ… Newest first
    }

    public static function getRelations(): array
    {
        return [
            // Add relation managers here later if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Harta';
    }

    public static function getPluralLabel(): string
    {
        return 'Hartanah';
    }
}