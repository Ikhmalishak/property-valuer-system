<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Filament\Resources\DocumentResource\Pages\CreateDocument;
use App\Filament\Resources\DocumentResource\Pages\EditDocument;
use App\Filament\Resources\DocumentResource\Pages\ListDocuments;
use App\Filament\Resources\DocumentResource\RelationManagers;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\Textarea;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected function handleRecordCreation(array $data): Model
{
    // Get the max id from the documents table and increment by 1
    $nextId = Document::max('id') + 1;

    // Manually assign the ID before create
    $data['id'] = $nextId;

    return Document::create($data);
}

public static function form(Form $form): Form
{
    return $form
        ->schema([
            TextInput::make('id')
                ->integer()
                ->required()
                ->label('Document ID')
                ->default(self::getNextDocumentId()), // Static call to get next ID

            TextInput::make('file_name')
                ->required()
                ->maxLength(255)
                ->label('File Name')
                ->hidden(),

            Select::make('file_type')
                ->required()
                ->label('File Type')
                ->options([
                    'pdf' => 'PDF',
                    'docx' => 'DOCX',
                    'txt' => 'TXT',
                    'jpg' => 'JPG',
                    'png' => 'PNG',
                ])
                ->hidden(),

                Select::make('user_id')
                ->label('User')
                ->options(User::all()->pluck('name', 'id'))
                ->searchable()
                ->required()
                ->live()
                ->afterStateUpdated(fn ($state, callable $set) => $set('email', optional(User::find($state))?->email))
                ->reactive(),

            TextInput::make('email')
                ->email()
                ->required()
                ->label('Email')
                ->default(fn (callable $get) => optional(User::find($get('user_id')))->email),

            Select::make('service_id')
                ->label('Service')
                ->relationship('service', 'name') // assumes Service has 'name' field
                ->required()
                ->searchable(),

            Select::make('application_status_id')
                ->label('Application Status')
                ->relationship('applicationStatus', 'name') // ApplicationStatus model
                ->required()
                ->searchable(),

            TextInput::make('full_name')
                ->required()
                ->maxLength(255)
                ->label('Full Name'),

            TextInput::make('ic_number')
                ->required()
                ->maxLength(255)
                ->label('IC Number'),

            TextInput::make('property_address')
                ->required()
                ->label('Property Address'),

            TextInput::make('phone')
                ->required()
                ->label('Phone'),

            Textarea::make('additional_info')
                ->label('Additional Info')
                ->nullable(),

            FileUpload::make('file_path')
                ->label('Upload File')
                ->disk('public')
                ->directory('documents')
                ->preserveFilenames()
                ->required()
                ->afterStateUpdated(function ($state, callable $set) {
                    if ($state && is_array($state)) {
                        $filename = pathinfo($state['name'], PATHINFO_FILENAME);
                        $extension = strtolower(pathinfo($state['name'], PATHINFO_EXTENSION));

                        $set('file_name', $filename);
                        $set('file_type', $extension);
                    }
                })
                ->reactive(),
        ]);
}

// Static method to get the next available Document ID
public static function getNextDocumentId(): int
{
    // Replace 'documents' with your actual table name if different
    $lastId = DB::table('documents')->max('id');

    return $lastId ? $lastId + 1 : 1;
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