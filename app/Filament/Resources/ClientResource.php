<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\Pages\ViewProperties;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')->required()->maxLength(255),
            TextInput::make('email')->email()->required()->maxLength(255),
            TextInput::make('branch')->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
        TextColumn::make('name')
            ->label('Client Name')
            ->url(fn($record) => ViewProperties::getUrl(['record' => $record->id]))
            ->openUrlInNewTab()
            ->color('primary')
            ->formatStateUsing(fn($state) => "<span class='underline hover:text-blue-700'>$state</span>")
            ->html()
            ->searchable()
            ->sortable(),

            TextColumn::make('email')->searchable(),
            TextColumn::make('branch'),
            TextColumn::make('created_at')->dateTime()->label('Created'),
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
        'index' => Pages\ListClients::route('/'),
        'create' => Pages\CreateClient::route('/create'),
        'edit' => Pages\EditClient::route('/{record}/edit'),
        'view-properties' => Pages\ViewProperties::route('/view-properties/{record}'),
    ];
    }
}
