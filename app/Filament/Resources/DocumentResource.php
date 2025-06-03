<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Filament\Resources\DocumentResource\RelationManagers;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id')
                    ->integer()
                    ->required()
                    ->label('Document ID'),

                TextInput::make('file_name')
                    ->required()
                    ->maxLength(255)
                    ->label('File Name'),

                Select::make('file_type')
                    ->required()
                    ->label('File Type')
                    ->options([
                        'pdf' => 'PDF',
                        'docx' => 'DOCX',
                        'txt' => 'TXT',
                        'jpg' => 'JPG',
                        'png' => 'PNG',
                    ]),

                FileUpload::make('file_path')
                    ->label('Upload File')
                    ->disk('public')           // Uses the public disk
                    ->directory('documents')   // Saves to storage/app/public/documents
                    ->preserveFilenames()      // Keeps original filename
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable(),
                TextColumn::make('file_name')->sortable()->searchable(),
                TextColumn::make('file_type')->badge(),
                TextColumn::make('file_path')
                    ->label('File')
                    ->formatStateUsing(fn (string $state): string => basename($state)),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}