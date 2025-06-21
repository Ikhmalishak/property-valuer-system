<?php

namespace App\Filament\Resources;

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
                    ->label('Client')
                    ->required(),

                TextInput::make('invoice_number')
                    ->label('Invoice Number')
                    ->required()
                    ->maxLength(255),

                TextInput::make('amount')
                    ->label('Amount (MYR)')
                    ->numeric()
                    ->required(),

                DateTimePicker::make('due_date')
                    ->label('Due Date')
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
                    ->label('Issued Date')
                    ->required(),

                DateTimePicker::make('last_reminder_sent')
                    ->label('Last Reminder Sent')
                    ->nullable(),

                Toggle::make('amanah_raya_paid')
                    ->label('Amanah Raya Paid')
                    ->default(false),

                FileUpload::make('file_path')
                    ->label('Invoice Document')
                    ->directory('invoices')
                    ->disk('public')
                    ->nullable(),

                TextInput::make('file_name')
                    ->label('File Name'),

                TextInput::make('file_type')
                    ->label('File Type')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client.name')
                    ->label('Client')
                    ->url(fn($record) => ViewProperties::getUrl(['record' => $record->client_id]))
                    ->openUrlInNewTab()
                    ->color('primary')
                    ->formatStateUsing(fn($state) => "<span class='underline hover:text-blue-700'>$state</span>")
                    ->html()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('invoice_number')
                    ->label('Invoice Number')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('amount')
                    ->label('Amount (MYR)')
                    ->money('MYR')
                    ->sortable(),

                TextColumn::make('due_date')
                    ->label('Due Date')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->color(static function ($state, $record) {
                        return $record->status === 'paid' ? 'success' : 'danger';
                    }),

                ToggleColumn::make('amanah_raya_paid')
                    ->label('Amanah Raya Paid'),

                TextColumn::make('issued_date')
                    ->label('Issued Date')
                    ->dateTime(),

                TextColumn::make('file_name')
                    ->label('File Name')
                    ->limit(30),

                TextColumn::make('file_type')
                    ->label('File Type'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('reminder_frequency')
                    ->label('Reminder Frequency')
                    ->options([
                        'none' => 'None',
                        'weekly' => 'Weekly',
                        'monthly' => 'Monthly',
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
                        $record->sendReminder();
                    })
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
}
