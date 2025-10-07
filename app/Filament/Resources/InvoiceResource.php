<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Filament\Notifications\Notification;
use App\Filament\Resources\ClientResource\Pages\ViewProperties;
use App\Models\Property;
use Filament\Tables\Filters\SelectFilter;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;
    
       protected static ?int $navigationSort = 2;

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
                    ->options(Property::all()->pluck('nombor_kait', 'id'))
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
                    ->label('Tarikh Akhir (tarikh akhir penghantaran peringatan)')
                    ->required(),

                Select::make('reminder_frequency')
                    ->label('Kekerapan Peringatan')
                    ->options([
                        '1_minute' => '1 Minit',
                        '7_days' => '7 Hari',
                        '14_days' => '14 Hari',
                        '30_days' => '30 Hari',
                    ])
                    ->default('14_days')
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
                    ->label('Tarikh Didaftarkan')
                    ->required(),

                FileUpload::make('file_path')
                    ->label('Invois Dokumen')
                    ->directory('invoices')
                    ->disk('public')
                    ->preserveFilenames()
                    ->nullable()
                    ->storeFileNamesIn('file_name'),

                FileUpload::make('file_path2')
                    ->label('Dokumen Peringatan Pertama')
                    ->directory('invoices/extra')
                    ->disk('public')
                    ->preserveFilenames()
                    ->storeFileNamesIn('file_name2')
                    ->hidden(), // Hidden in form too (optional)

                FileUpload::make('file_path3')
                    ->label('Dokumen Peringatan Kedua')
                    ->directory('invoices/extra')
                    ->disk('public')
                    ->preserveFilenames()
                    ->storeFileNamesIn('file_name3')
                    ->hidden(), // Hidden in form too (optional)

                TextInput::make('file_name')
                    ->label('Nama Fail')
                    ->readonly()
                    ->dehydrated(true)
                    ->hidden(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client.name')
                    ->label('Nama Klien')
                    ->url(fn($record) => ViewProperties::getUrl(['record' => $record->client_id]))
                    ->openUrlInNewTab()
                    ->color('info')
                    ->formatStateUsing(fn($state) => "<span class='underline hover:text-blue-700'>$state</span>")
                    ->html()
                    ->sortable()
                    ->searchable(),
      TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->color(static function ($state, $record) {
                        return match ($record->status) {
                            'pending' => 'warning',
                            'overdue' => 'danger',
                            'paid' => 'success',
                            default => 'gray',
                        };
                    })
                    ->badge(), // Shows as colored badge

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
                    ->url(fn($record) => $record->property && $record->property->file_path
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
                    ->openUrlInNewTab()
                    ->limit(30)
                    ->tooltip(fn($record) => $record->file_name),

          
                TextColumn::make('due_date')
                    ->label('Tarikh Akhir')
                    ->formatStateUsing(fn($state) => $state?->format('Y-m-d')),

                TextColumn::make('issued_date')
                    ->label('Tarikh Didaftarkan')
                    ->formatStateUsing(fn($state) => $state?->format('Y-m-d')),
            ])
            ->filters([
                SelectFilter::make('reminder_frequency')
                    ->label('Kekerapan Peringatan')
                    ->options([
                        '1_minute' => '1 Minit',
                        '7_days' => '7 Hari',
                        '14_days' => '14 Hari',
                        '30_days' => '30 Hari',
                    ]),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'overdue' => 'Overdue',
                        // 'paid' => 'Paid' ← Removed so users can't filter paid (since not shown)
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                Action::make('enableAutoReminders')
                    ->label('Hantar Peringatan')
                    ->icon('heroicon-s-bell')
                    ->visible(fn($record) => $record->status !== 'paid')
                    ->color(fn($record) => $record->reminders_sent_count === 0 ? 'info' : 'success')
                    ->action(function (Invoice $record) {
                        $sent = $record->sendRecurringReminder();

                        if ($sent) {
                            if (empty($record->reminder_frequency)) {
                                $record->reminder_frequency = '14_days';
                                $record->save();
                            }

                            Notification::make()
                                ->title('Peringatan Dihantar')
                                ->body('Peringatan pertama telah dihantar! Peringatan seterusnya akan dihantar secara automatik.')
                                ->success()
                                ->send();
                        } else {
                            Notification::make()
                                ->title('Failed to Send Reminder')
                                ->body('No email was sent. Check mail configuration and client email address.')
                                ->danger()
                                ->send();
                        }
                    })
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                ->label('Padam'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Add relation managers here if needed later
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

    /**
     * Filter only pending and overdue invoices.
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereIn('status', ['pending', 'overdue']) // 👈 Only show pending & overdue
            ->orderByRaw("FIELD(status, 'pending','overdue','paid')")
            ->orderByRaw("COALESCE(issued_date, created_at) DESC");
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
        return 'Invois';
    }

    public static function getPluralLabel(): string
    {
        return 'Invois';
    }
}