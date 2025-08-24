<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentsResource\RelationManagers\DocumentsRelationManager;
use App\Filament\Resources\InvoiceResource\Pages;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;
use App\Filament\Resources\ClientResource\Pages\ViewProperties;
use App\Models\Property; 
use Filament\Tables\Filters\SelectFilter;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('client_id')
                    ->relationship('client', 'name')
                    ->label('ID Klien')
                    ->required(),

                Select::make('property_id')
                    ->label('Harta')
                    ->options(Property::all()->pluck('nombor_kait', 'id')) // assuming nombor_kait is property identifier
                    ->required()
                    ->searchable()
                    ->preload(),

                TextInput::make('invoice_number')
                    ->label('Nombor Invois')
                    ->required()
                    ->maxLength(255),

                TextInput::make('amount')
                    ->label('Amaun (MYR)')
                    ->numeric()
                    ->required(),

                DateTimePicker::make('due_date')
                    ->label('Tarikh Akhir')
                    ->required(),

                Select::make('reminder_frequency')
                    ->label('Kekerapan Peringatan')
                    ->options([
                        'bi-weekly' => '14 Hari',
                        'monthly' => 'Bulanan',
                    ])
                    ->required(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'overdue' => 'Overdue',
                    ])
                    ->required(),

                DateTimePicker::make('issued_date')
                    ->label('Tarikh Dikeluarkan')
                    ->required(),

              

                FileUpload::make('file_path')
                    ->label('Invois Dokumen')
                    ->directory('invoices') // stored in storage/app/public/invoices
                    ->disk('public')
                    ->preserveFilenames()
                    ->nullable()
                    ->storeFileNamesIn('file_name'), // This automatically stores the original filename

                    FileUpload::make('file_path2')
                ->label('Invois Dokumen 2')
                ->directory('invoices/extra')
                ->disk('public')
                ->preserveFilenames()
                ->storeFileNamesIn('file_name2'),

            FileUpload::make('file_path3')
                ->label('Invois Dokumen 3')
                ->directory('invoices/extra')
                ->disk('public')
                ->preserveFilenames()
                ->storeFileNamesIn('file_name3'),


                TextInput::make('file_name')
                    ->label('Nama Fail')
                    ->readonly() // Change from disabled() to readonly() so it can still be updated programmatically
                    ->dehydrated(true) // Ensure it's included in form data
                    ->hidden(), // Hide this field since it's automatically populated

            ]);
    }

public static function getNavigationSort(): int
    {
        return 3;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client.name')
                    ->label('Nama Klien')
                    ->url(fn($record) => ViewProperties::getUrl(['record' => $record->client_id]))
                    ->openUrlInNewTab()
                    ->color('primary')
                    ->formatStateUsing(fn($state) => "<span class='underline hover:text-blue-700'>$state</span>")
                    ->html()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('property.nombor_kait')
                    ->label('Nombor Kait')
                    ->searchable(),

                TextColumn::make('invoice_number')
                    ->label('Nombor Invois')
                    ->sortable()
                    ->searchable(),

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


              TextColumn::make('property.file_name')
                    ->label('Surat Iringan')
                    ->url(fn($record) => $record->property->file_path
                        ? asset('storage/' . $record->property->file_path)
                        : null)
                    ->openUrlInNewTab()
                    ->limit(30)
                    ->tooltip(fn($record) => $record->file_name),
                    
                    TextColumn::make('file_name')
                    ->label('Invois')
                    ->url(fn($record) => $record->file_path
                        ? asset('storage/' . $record->file_path)
                        : null)
                    ->limit(30)
                    ->tooltip(fn($record) => $record->file_name),

                      TextColumn::make('file_name2')
                ->label('Peringatan Kedua')
                ->url(fn($record) => $record->file_path2 ? asset('storage/' . $record->file_path2) : null)
                ->openUrlInNewTab()
                ->limit(25)
                ->tooltip(fn($record) => $record->file_name2),

            TextColumn::make('file_name3')
                ->label('Peringatan Ketiga')
                ->url(fn($record) => $record->file_path3 ? asset('storage/' . $record->file_path3) : null)
                ->openUrlInNewTab()
                ->limit(25)
                ->tooltip(fn($record) => $record->file_name3),

              

                        TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->color(static function ($state, $record) {
                        return $record->status === 'paid' ? 'success' : 'danger';
                    }),

                    
               TextColumn::make('due_date')
    ->label('Tarikh Akhir')
    ->formatStateUsing(fn($state) => $state?->format('Y-m-d')),

TextColumn::make('issued_date')
    ->label('Tarikh Dikeluarkan')
    ->formatStateUsing(fn($state) => $state?->format('Y-m-d')),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('reminder_frequency')
                    ->label('Kekerapan Peringatan')
                    ->options([
                        'bi-weekly' => '14 Hari',
                        'monthly' => 'Bulanan',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'overdue' => 'Overdue',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                Action::make('sendReminder')
                    ->label('Send Reminder')
                    ->icon('heroicon-o-bell')
                    ->action(function (Invoice $record) {
                        $record->sendFirstReminder();
                    })
                    ->visible(fn(Invoice $record) => !$record->is_reminder_sent)
                    ->requiresConfirmation()
                    ->color('success'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        if (!empty($data['file_path'])) {
            $data['file_name'] = basename($data['file_path']);
        }

        return $data;
    }
  
    public static function mutateFormDataBeforeUpdate(array $data): array
    {
        if (!empty($data['file_path'])) {
            $data['file_name'] = basename($data['file_path']);
        }

        return $data;
    }
    public static function getNavigationLabel(): string
    {
        return 'Invois';  // Change 'Home' to your desired dashboard name
    }
    public static function getPluralLabel(): string
    {
        return 'Invois'; // new plural name
    }
}