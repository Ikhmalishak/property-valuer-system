<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Filament\Resources\DocumentResource\RelationManagers;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('file_name')
                    ->label('Nama Dokumen')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('file_type')
                    ->label('Jenis Dokumen')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('file_path')
                    ->label('Lokasi Dokumen')
                    ->directory('documents') // stored in storage/app/public/documents
                    ->disk('public') // or 's3' if needed
                    ->preserveFilenames()
                    ->storeFileNamesIn('file_name') // optional
                    ->required()
            ]);
    }

    public static function getNavigationSort(): int
    {
        return 7;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('file_name')
                ->label('Nama Dokumen')
                    ->searchable(),
                Tables\Columns\TextColumn::make('file_type')
                    ->label('Jenis Dokumen')
                    ->searchable(),
                Tables\Columns\TextColumn::make('file_path')
                    ->label('Lokasi Dokumen')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tarikh Dicipta')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Tarikh Dikemaskini')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'view' => Pages\ViewDocument::route('/{record}'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Dokumen';  // Change 'Home' to your desired dashboard name
    }
    public static function getPluralLabel(): string
    {
        return 'Dokument'; // new plural name
    }

    public static function shouldRegisterNavigation(): bool
{
    return false;
}
}