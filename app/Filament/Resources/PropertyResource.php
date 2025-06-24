<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Filament\Resources\PropertyResource\RelationManagers;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('client_id')
                ->label('Client')
                ->relationship('client', 'name')
                ->required(),
            TextInput::make('nombor_kait')->required(),
            TextInput::make('nombor_lot')->required(),
            TextInput::make('nombor_geran')->required(),
            TextInput::make('daerah')->required(),
            TextInput::make('mukim')->required(),
            FileUpload::make('file_path')
                ->label('Property Document')
                ->directory('properties') // stored in storage/app/public/invoices
                ->disk('public')
                ->preserveFilenames()
                ->nullable()
                ->storeFileNamesIn('file_name'), // This automatically stores the original filename

            TextInput::make('file_name')
                ->label('File Name')
                ->readonly() // Change from disabled() to readonly() so it can still be updated programmatically
                ->dehydrated(true) // Ensure it's included in form data
                ->hidden(), // Hide this field since it's automatically populated
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('client.name')->label('Client')->searchable(),
            TextColumn::make('nombor_kait'),
            TextColumn::make('nombor_lot'),
            TextColumn::make('nombor_geran'),
            TextColumn::make('daerah'),
            TextColumn::make('mukim'),
            TextColumn::make('file_name')
                ->label('File')
                ->url(fn($record) => $record->file_path
                    ? asset('storage/' . $record->file_path)
                    : null)
                ->openUrlInNewTab()
                ->limit(30)
                ->tooltip(fn($record) => $record->file_name),
            TextColumn::make('created_at')->dateTime(),
        ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
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
}
